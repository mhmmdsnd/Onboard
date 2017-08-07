<?php

namespace App\Http\Controllers\Onboard;

use App\ClearedItem;
use App\Onboard;
use App\OnboardItem;
use App\Subdivision;
use App\Workflow;
use App\WorkflowDetail;
use App\OnRequest;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Onboard\OnboardController;

class HRExitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createDefaultItem($onboard_id,$item_id)
    {
        $onboard_item = new OnboardItem();
        $onboard_item->onboard_id = $onboard_id;
        $onboard_item->item_id = $item_id;
        $onboard_item->created_by = Auth::user()->id;
        $onboard_item->save();
    }
    public function index(){

        $hr_column = "Cleared Date";
        $join_column = "Exit Date";
        $exit_column = "Clearance Date";
        $title = "exit";
        $now = Carbon::now();
        $role = RoleUser::where('user_id',Auth::user()->id)->pluck('role_id')->first();
        #UNTUK MELAKUKAN PROSES AMBIL URL
        if($role == 2) $url = "ITAdm";
        elseif ($role == 3) $url = "ITInfra";
        elseif ($role == 4) $url = "ITApps";
        elseif ($role == 7) $url = "ga-detail";
        else $url = "users";

        #CHECK LIST HR BERDASARKAN ROLE
        $list = OnRequest::with('onboard.company','onboard.division')->where('type_request','exit')->orderby('created_at','asc')->get();
        return view('listhr', compact('list','now','url','hr_column','join_column','exit_column','title'));
    }
    public function hrexit($onboard_id){

        $detail = Onboard::with('company','division','workplace','position')->where('id',$onboard_id)->first();
        #MASTER ONBOARD
        $result = Subdivision::distinct()->whereHas('item.employee_item',function ($q) use ($onboard_id) {
            $q->where('onboard_id',$onboard_id);
        })->get()->pluck('name','id');
        foreach ($result as $i=>$xy) {
            $suggested[$i] = suggested_detail($onboard_id,'','',$i);
        }

        return view('exitform',compact('detail','result','suggested'));
    }
    public function store(Request $request){
        #CALL ONBOARD
        $onboard = new OnboardController();
        #INPUT TO REGISTER WHERE STATUS = EXIT
        $req = new OnRequest();
        $req->onboard_id = $request->input('onboard_id');
        $req->request_date = Carbon::now();
        $req->request_by = Auth::user()->id;
        $req->ticket = Str::random(4);
        $req->type_request = "exit";
        $req->save();
        #UPDATE TO ONBOARD (FOR INFORMATION RESIGN)
        $upd_onboard = Onboard::find($request->input('onboard_id'));
        $upd_onboard->exit_date = $request->input('exit_date');
        $upd_onboard->save();
        #CREATE EMPLOYEE_ITEM
        $onboard_item = OnboardItem::where('onboard_id',$request->input('onboard_id'))->first();
        if(!$onboard_item){
            $onboardItem = array('74','93','50','46','94','91','68','71','86');
            foreach ($onboardItem as $emp_item){
                $this->createDefaultItem($request->input('onboard_id'),$emp_item);
            }
        }

        #CREATE WORKFLOW FROM TEAM IT
        $itcat_result = Subdivision::distinct()->has('item.employee_item')->where('role_id','!=',0)->get()->pluck('id');
        foreach($itcat_result as $it_cat){
            $onboard->wfstore($req->id,$it_cat,'');
        }
        #SENT EMAIL TO ALL TEAM IT
        sentemail(5,$req->id,'');

        Session::flash('flash_message', 'New Exit Employee Request succesfully added!');
        return redirect('hrexit');
    }
    public function itstore(Request $request)
    {
        #MASTER ONBOARD
        $it_category = $request->input('it_category');
        $type_request = $request->input('type_request');

        $request_id = $request->input('id');
        $onboard_id = $request->input('onboard_id');
        $is_checked = $request->input('is_checked');
        $comment = $request->input('comment');
        #START CHECK WORKFLOW
        $checker = Workflow::where('request_id',$request_id)->where('it_category',$it_category)->first();

        #LOOP PREPARED ITEM & WORKFLOW DETAIL
        $count_checked = count($is_checked);
        $check_cleared = ClearedItem::whereHas('item',function ($q) use ($it_category){ $q->where('subdivision_id',$it_category); })
            ->where('onboard_id',$onboard_id)->count();
        if($request->input('submit')){
            if($count_checked > $check_cleared){
                foreach ($is_checked as $isc ) {
                    wfstore_email($request_id,$isc,'',$it_category,$type_request);
                }
            }
        }
        if($request->input('completed')) {
            foreach ($is_checked as $isc ) {
                wfstore_email($request_id,$isc,'',$it_category,$type_request);
            }
            Workflow::where('id',$checker->id)->update(['comment'=>$comment,'completed_by'=>Auth::user()->id,'completed_at'=>Carbon::now()]); #UPDATE COMPLETED
        }

        $wf_clear = Workflow::where('request_id',$request_id)->count();
        $wf_check = Workflow::where('request_id',$request_id)->whereNotNull('completed_at')->count();
        if ($wf_check == $wf_clear)
        {
            Onboard::where('id',$onboard_id)->update(['clearance_date'=>Carbon::now(),'updated_by'=>Auth::user()->id]); #UNTUK UPDATE SISTEM EXIT DATE
            //sentemail(2,$request_id,''); #EMAIL TO REVIEWER
            #REMOVE USERS & UPDATE TO REQUEST
            $result = User::where('employee_id',$onboard_id)->first();
            if($result) {
                #UPDATE TO REQUEST
                $onrequest = OnRequest::find($request_id);
                $onrequest->delivery_date = Carbon::now();
                $onrequest->save();
                #REMOVE USERS
                $user = User::find($result['id']);
                $user->detachRole(6);
                $user->delete();
            }
        }

        Session::flash('flash_message', 'Workflow Exit Process stage has been proceed!');
        return redirect('hrexit');
    }
    #END IT ADMIN
}
