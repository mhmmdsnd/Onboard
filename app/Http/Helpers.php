<?php

use App\Workflow;
use App\WorkflowDetail;
use App\RoleUser;
use App\SuggestedList;
use App\PreparedItem;
use App\CheckedItem;
use App\OnboardItem;
use App\ClearedItem;
use App\OnRequest;

#START DATEWORKFLOW
function dateWorkflow($request_id,$it_category,$holding_id,$company_id,$division_id,$position_id){
    #TANGGAL WORKFLOW
    $result = Workflow::where('request_id',$request_id)->where('it_category',$it_category)->first();
    $data_req = OnRequest::where('id',$request_id)->first();
    #SUGGESTED LIST & COUNT WF DETAIL

    if ($data_req['type_request'] == 'join') $suggested = suggested_list($it_category,$holding_id,$company_id,$division_id,$position_id)->count();
    else $suggested = OnboardItem::whereHas('item',function ($q) use ($it_category) {
        $q->where('subdivision_id',$it_category);
    })->where('onboard_id',$data_req['onboard_id'])->count();

    $wf_detail = WorkflowDetail::where('workflow_id',$result['id'])->count();
    ($result['completed_at']) ? $created_date = Carbon\Carbon::parse($result->completed_at)->format('Y-m-d') : $created_date = $wf_detail."/".$suggested;
    return $created_date;
}
function statusWorkflow($onboard_id)
{
    $result = OnRequest::where('onboard_id',$onboard_id)->first();
    if(!$result['delivery_date']){
        $hasil = "On Progress Onboard";
    }elseif ($result['type_request']=='exit'){
        $hasil = "On Progress Exit";
    }else $hasil = null;

    return $hasil;
}
#END DATEWORKFLOW
#START SEND EMAIL
#(1=NEW-TO-IT,2=IT-TO-HR,3=HR-TO-USR,4=USR-TO-HR,5=HR-TO-IT[EXIT])
function sentemail($stage,$id,$name)
{
    $url = url("/"); #URL BY REQUEST
    if($stage == 1){
        $sent = RoleUser::with('users')->whereIn('role_id',[2,3,4,5,7])->where('user_id','!=',1)->get();
        foreach ($sent as $input){
            if($input->role_id == 2) $url_role = "ITAdm";
            elseif ($input->role_id == 3) $url_role = "ITInfra";
            elseif ($input->role_id == 4) $url_role = "ITApps";
            else $input->role_id = "Users";
            $input = array_add($input,'name',$name);
            $data_mail = array(
                'itname' => $input->users->name,
                'name' => $name,'request_id' => $id,
                'user_type' =>$url_role,
                'url'=>$url, 'type_request'=>'join'
            );
            try{
                Mail::send('emails.emails',['data'=>$data_mail],function ($m) use ($input) {
                    $m->from("npd@sinarmasmining.com", null);
                    $m->to($input['users']['email'], null)->subject('New Employee OnBoarding : '.$input['name']);
                });
            } catch (\Exception $error){
                #echo $error;
            }
        }
    } elseif ($stage == 2){
        $hrsent = RoleUser::with('users')->where('role_id', 5)->where('user_id','!=',1)->get();
        $detail = OnRequest::with('onboard.division','onboard.position')->where('id',$id)->first();
        foreach ($hrsent as $hrinput) {
            if($detail->type_request == 'join')
            {
                #INFORMATION ADD-ON
                $hrinput = array_add($hrinput, 'request_id', $id);
                $hrinput = array_add($hrinput, 'name',$detail->onboard->name);
                $hrinput = array_add($hrinput, 'url',$url);
                $hrinput = array_add($hrinput, 'type_request',$detail->type_request);
                #MASTER ONBOARD
                for($i=1;$i<=5;$i++){
                    $suggested[$i] = suggested_detail('',$id,'review',$i);
                }

                try {
                    Mail::send('emails.hrmail', ['sent' => $hrinput,'admin'=>$suggested[1],'infra'=>$suggested[2],'apps'=>$suggested[3]
                        ,'hrself'=>$suggested[4],'gadept'=>$suggested[5]], function ($m) use ($hrinput) {
                        $m->from("npd@sinarmasmining.com", null);
                        $m->to($hrinput['users']['email'], null)->subject('Review Employee Onboarding : '.$hrinput['name']);
                    });
                } catch (\Exception $error) {
                    #echo $error;
                }
            } else{
                #INFORMATION ADD-ON
                $hrinput = array_add($hrinput, 'request_id', $id);
                $hrinput = array_add($hrinput, 'name',$detail->onboard->name);
                $hrinput = array_add($hrinput, 'url',$url);
                $hrinput = array_add($hrinput, 'type_request',$detail->type_request);
                $hrinput = array_add($hrinput, 'division',$detail->onboard->division->name);
                $hrinput = array_add($hrinput, 'position',$detail->onboard->position->name);
                try {
                    Mail::send('emails.hrmail', ['sent' => $hrinput], function ($m) use ($hrinput) {
                        $m->from("npd@sinarmasmining.com", null);
                        $m->to($hrinput['users']['email'], null)->subject('Employee Clearance Confirmation : '.$hrinput['name']);
                    });
                } catch (\Exception $error) {
                    #echo $error;
                }
            }

        }
    } elseif ($stage == 3) {
        $sent = OnRequest::with('onboard.company','onboard.subdivision')->where('id',$id)->first();
        $sent = array_add($sent, 'url',$url);
        if ($sent->onboard->email)
        {
            try {
                Mail::send('emails.usmail', ['users' => $sent], function ($mg) use ($sent) {
                    $mg->from("npd@sinarmasmining.com", null);
                    $mg->to($sent->onboard->email, null)->subject('[IT Division] Welcome aboard '.$sent->onboard->name);
                });
            } catch (\Exception $error) {
                #dd($error->getMessage());
            }
        }
    }
    elseif ($stage == 4){
        #SENT EMAIL FROM USERS TO HR USERS
        $hrsent = RoleUser::with('users')->where('role_id', 5)->where('user_id','!=',1)->get();
        foreach ($hrsent as $hrinput) {
            $hrinput = array_add($hrinput, 'request_id', $id);
            $hrinput = array_add($hrinput, 'url',$url);
            #MASTER ONBOARD
            $detail = OnRequest::with('onboard')->where('id',$id)->first();
            for($i=1;$i<=5;$i++){
                $suggested[$i] = suggested_detail($detail['onboard_id'],'','',$i);
            }
            try {
                Mail::send('emails.revmail', ['sent' => $hrinput,'admin'=>$suggested[1],'infra'=>$suggested[2],'apps'=>$suggested[3]
                    ,'hrself'=>$suggested[4],'gadept'=>$suggested[5]], function ($m) use ($hrinput) {
                    $m->from("npd@sinarmasmining.com", null);
                    $m->to($hrinput['users']['email'], null)->subject('Employee Checklist');
                });
            } catch (\Exception $error) {
                #echo $error;
            }
        }
    }elseif ($stage == 5){ #EXIT EMAL PROCESS
        $sent = RoleUser::with('users')->whereIn('role_id',[2,3,4,5,7])->where('user_id','!=',1)->get();
        $data_user = OnRequest::with('onboard.division','onboard.position')->where('id',$id)->first();
        foreach ($sent as $input){
            if($input->role_id == 2) $url_role = "ITAdm";
            elseif ($input->role_id == 3) $url_role = "ITInfra";
            elseif ($input->role_id == 4) $url_role = "ITApps";
            $input = array_add($input,'name',$data_user->onboard->name);
            $data_mail = array(
                'itname' => $input->users->name,
                'name' => $data_user->onboard->name,'request_id' => $id,
                'user_type' =>$url_role,'url'=>$url,
                'type_request'=>$data_user->type_request,
                'division'=>$data_user->onboard->division->name,
                'position'=>$data_user->onboard->position->name
            );
            try{
                Mail::send('emails.emails',['data'=>$data_mail],function ($m) use ($input) {
                    $m->from("npd@sinarmasmining.com", null);
                    $m->to($input['users']['email'], null)->subject('Employee Clearance Request : '.$input['name']);
                });
            } catch (\Exception $error){
                #echo $error;
            }
        }
    }
}
#END SEND EMAIL
#START SUGGESTED LIST
function suggested_list($it_category,$holding_id,$company_id,$division_id,$position_id)
{
    #SUGGESTED LIST (UPDATE)
    $suggested = SuggestedList::whereHas('item.subdivision',function ($q) use ($it_category) {
        $q->where('subdivision_id',$it_category);
    })
        ->where(function ($query) use ($holding_id){
            $query->where('holding_id',$holding_id)->orWhere('holding_id',0);
        })
        ->where(function ($query) use ($company_id){
            $query->where('company_id',$company_id)->orWhere('company_id',0);
        })
        ->where(function ($query) use ($division_id){
            $query->where('division_id',$division_id)->orWhere('division_id',0);
        })
        ->where(function ($query) use ($position_id){
            $query->where('position_id',$position_id)->orWhere('position_id',0);
        })
        ->get();

    return $suggested;
}
#END SUGGESTED LIST
#START WORKFLOW DETAIL & PREPARED ITEM
function wfstore_detail($request_id,$item_id,$it_category,$holding_id,$company_id,$division_id,$position_id)
{
    $checker = Workflow::where('request_id',$request_id)->where('it_category',$it_category)->first();
    $wf_detail = WorkflowDetail::where('workflow_id',$checker->id)->where('item_id',$item_id)->first();
    if ($wf_detail == null){

        $wf_detail = new WorkflowDetail();
        $wf_detail->workflow_id = $checker->id;
        $wf_detail->item_id = $item_id;
        $wf_detail->created_by = Auth::user()->id;
        $wf_detail->save();

        $prepared_item = new PreparedItem();
        $prepared_item->request_id = $request_id;
        $prepared_item->item_id = $item_id;
        $prepared_item->created_by = Auth::user()->id;
        $prepared_item->save();
    }

    #UPDATE WORKFLOW AFTER COUNT
    $suggested = suggested_list($it_category,$holding_id,$company_id,$division_id,$position_id)->count();
    $wf_detail = WorkflowDetail::where('workflow_id',$checker->id)->count();
    if ($wf_detail == $suggested){
        Workflow::where('id',$checker->id)->update(['completed_by'=>Auth::user()->id,'completed_at'=>Carbon\Carbon::now()]);
    }
}
#WORKFLOW HR CHECK & USERS
function wfstore_email($request_id,$item_id,$comment,$it_category,$type_request=null)
{
    $onrequest = OnRequest::find($request_id);
    if ($type_request == 'join'){
        if($it_category == 6){
            $checked_item = CheckedItem::where('request_id',$request_id)->where('item_id',$item_id)->first();
            if ($checked_item == null)
            {
                $checked_item = new CheckedItem();
                $checked_item->request_id = $request_id;
                $checked_item->item_id = $item_id;
                $checked_item->created_by = Auth::user()->id;
                $checked_item->save();
            }
        } elseif ($it_category == 7){
            $onboard_item = OnboardItem::where('onboard_id',$onrequest->onboard_id)->where('item_id',$item_id)->first();
            if($onboard_item == null)
            {
                $onboard_item = new OnboardItem();
                $onboard_item->onboard_id = $onrequest->onboard_id;
                $onboard_item->item_id = $item_id;
                $onboard_item->created_by = Auth::user()->id;
                $onboard_item->save();
            }
        }
    } else {
        $cleared_item = ClearedItem::where('onboard_id',$onrequest->onboard_id)->where('item_id',$item_id)->first();
        if($cleared_item == null)
        {
            $cleared_item = new ClearedItem();
            $cleared_item->onboard_id = $onrequest->onboard_id;
            $cleared_item->item_id = $item_id;
            $cleared_item->created_by = Auth::user()->id;
            $cleared_item->save();
        }
    }

    #INPUT TO SYSWF
    $checker = Workflow::where('request_id',$request_id)->where('it_category',$it_category)->first();
    if($checker == null){
        $checker = new Workflow();
        $checker->request_id = $request_id;
        $checker->user_id = Auth::user()->id;
        $checker->it_category = $it_category;
        $checker->comment = $comment;
        $checker->completed_by = Auth::user()->id;
        $checker->completed_at = Carbon\Carbon::now();
        $checker->save();

    }
}
#SUGGESTED LIST FOR CHECKER,USERS,HR
function suggested_detail($onboard_id,$request_id,$area,$it_category){
    if($request_id)
    {
        if($area == "review"){
            $suggested_detail = PreparedItem::with('workflows')->whereHas('item',function ($q) use ($it_category) {
                $q->where('subdivision_id',$it_category);
            })->where('request_id',$request_id)->get();

        }else{
            $suggested_detail = CheckedItem::whereHas('item',function ($q) use ($it_category) {
                $q->where('subdivision_id',$it_category);
            })->where('request_id',$request_id)->get();
        }

    } elseif ($onboard_id)
    {
        $suggested_detail = OnboardItem::whereHas('item',function ($q) use ($it_category) {
            $q->where('subdivision_id',$it_category);
        })->where('onboard_id',$onboard_id)->get();
    }
    return $suggested_detail;
}
