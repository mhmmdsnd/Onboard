<?php
/*Controller ini digunakan untuk function review (checker) dan users (admin/user)*/
namespace App\Http\Controllers\Onboard;

use App\PreparedItem;
use Illuminate\Http\Request;
use App\OnRequest;
use App\ClearedItem;
use App\Onboard;
use App\CheckedItem;
use App\OnboardItem;
use App\Workflow;
use App\Subdivision;
use App\RoleUser;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Regulus\ActivityLog\Models\Activity;

class HRGAController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

    }
    #CHECKER AREA
    public function reviewer($request_id)
    {
        $role = RoleUser::with('roles','subdivision')->where('user_id',Auth::user()->id)->first();
        $req = OnRequest::where('id',$request_id)->first();
        if ($req)  {
            $detail = Onboard::with('company','division','workplace','position')->where('id',$req['onboard_id'])->first();
            $workflow = Workflow::where('request_id',$request_id)->where('it_category',6)->first();
        }

        #DATA ITEM WITH REQUEST TYPE (JOIN, EXIT)
        $result = Subdivision::distinct()->whereHas('item.prepared_item',function ($q) use ($request_id) {
            $q->where('role_id','!=',0)->where('request_id',$request_id);
        })->get()->pluck('name','id');
        $request = Workflow::where('request_id',$request_id)->where('completed_by','!=','')->count();
        (count($result) == $request) ? $completed = "Done" : $completed = "";
        if($req->type_request == 'join'){
            #DATA CHECKED ITEM
            $checker = CheckedItem::where('request_id',$request_id)->get()->pluck('item_id')->toArray();
            foreach ($result as $i=>$subdiv) {
                $suggested[$i] = suggested_detail('',$request_id,'review',$i);
                $wf_comment[$i] = Workflow::where('request_id',$request_id)->where('it_category',$i)->first();
            }
        } else {
            #DATA CHECKED ITEM
            $checker = ClearedItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();
            foreach ($result as $i=>$subdiv) {
                $suggested[$i] = suggested_detail($req['onboard_id'],'','',$i);
                $wf_comment[$i] = Workflow::where('request_id',$request_id)->where('it_category',$i)->first();
            }
        }

        return view('reviewer',compact('req','role','workflow','result','detail','suggested','checker','wf_comment','completed'));
    }
    public function createstore(Request $request)
    {
        #CALL ONBOARD
        $onboard = new OnboardController();
        #MASTER ONBOARD
        $it_category = $request->input('it_category');
        $type_request = $request->input('type_request');

        $request_id = $request->input('id');
        $comment = $request->input('comment');
        #IS CHECKED
        $is_checked = $request->input('is_checked');
        $result = Subdivision::distinct()->whereHas('item.prepared_item',function ($q) use ($request_id) {
            $q->where('role_id','!=',0)->where('request_id',$request_id);
        })->get()->pluck('id');

        #START CHECK WORKFLOW
        $checker = Workflow::where('request_id',$request_id)->where('it_category',$it_category)->first();
        if($request->input('submit'))
        {
            #EMAIL TO REVIEWER
            $wf_check = count($is_checked[1])+count($is_checked[2])+count($is_checked[4])+count($is_checked[5]); #HITUNG JUMLAH ITEM YANG DICHECKLIST
            $wf_detail = CheckedItem::where('request_id',$request_id)->count(); #HITUNG JUMLAH ITEM YANG SUDAH DI CHECKLIST
            #LOOP PREPARED ITEM & WORKFLOW DETAIL
            if($wf_check > $wf_detail) {
                foreach ($result as $i ){
                    if($is_checked[$i]){
                        foreach ($is_checked[$i] as $ischecked){
                            wfstore_email($request_id,$ischecked,$comment,$it_category,$type_request);
                        }
                    }
                }
                sentemail(3,$request_id,'');
            }
        }
        if($request->input('completed'))
        {
            #LOOP PREPARED ITEM & WORKFLOW DETAIL
            foreach ($result as $i ){
                if($is_checked[$i]){
                    foreach ($is_checked[$i] as $ischecked){
                        wfstore_email($request_id,$ischecked,$comment,$it_category,$type_request);
                    }
                }
            }

            Workflow::where('id',$checker['id'])->update(['completed_by'=>Auth::user()->id,'completed_at'=>Carbon::now()]); #UPDATE DATE COMPLETED
            $onboard->wfstore($request_id,$it_category,$comment); #INPUT TO SYSWF
            sentemail(3,$request_id,'');#EMAIL TO REVIEWER
        }
        #END CHECK WORKFLOW
        Session::flash('flash_message', 'Reviewer proceed has been done!');
        return redirect('ListOnBoard');
    }
    #USERS AREA
    public function userview($request_id)
    {
        $req = OnRequest::where('id',$request_id)->first();
        if ($req)  {
            $detail = Onboard::with('company','division','workplace','position')->where('id',$req['onboard_id'])->first();
        }
        $type_request = $req->type_request;
        #MASTER ONBOARD
        if($type_request == 'join'){
            if(Auth::user()->hasRole(array('admin','management'))){
                $holding_id = $detail['company']['holdingId'];
                $company_id = $detail['company_id'];
                $division_id = $detail['division_id'];
                $position_id = $detail['position_id'];

                $employee = PreparedItem::where('request_id',$request_id)->get()->pluck('item_id')->toArray();
                $result = Subdivision::distinct()->whereHas('item.suggested_list',function ($q) use ($detail) {
                    $q->where('role_id','!=',0);
                })->get()->pluck('name','id');
                foreach ($result as $i=>$subdiv) {
                    $suggested[$i] = suggested_list($i,$holding_id,$company_id,$division_id,$position_id);
                }
            } else {
                $employee = OnboardItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();
                $result = Subdivision::distinct()->whereHas('item.checked_item',function ($q) use ($request_id) {
                    $q->where('role_id','!=',0)->where('request_id',$request_id);
                })->get()->pluck('name','id');
                foreach ($result as $i=>$subdiv) {
                    $suggested[$i] = suggested_detail('',$request_id,'',$i);
                }
            }

        } else
        {
            $employee = OnboardItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();
            $result = Subdivision::distinct()->whereHas('item.employee_item',function ($q) use ($req) {
                $q->where('role_id','!=',0)->where('onboard_id',$req['onboard_id']);
            })->get()->pluck('name','id');
            foreach ($result as $i=>$subdiv) {
                $suggested[$i] = suggested_detail($req['onboard_id'],'','',$i);
            }
        }

        $wf_comment = Workflow::where('request_id',$request_id)->where('it_category',6)->first();
        $us_comment = Workflow::where('request_id',$request_id)->where('it_category',7)->first();

        #CHECK IS ADMIN
        if(Auth::user()->hasRole(array('admin','management','hrcomb'))){
            return view('useradmin',compact('req','detail','activity','suggested','result','employee','wf_comment','us_comment')); #
        } else {
            return view('userview',compact('req','detail','suggested','result','employee','wf_comment','us_comment')); #
        }

    }
    public function userstore(Request $request)
    {
        #MASTER ONBOARD
        $it_category = $request->input('it_category');
        $type_request = $request->input('type_request');

        $request_id = $request->input('id');
        $onboard_id = $request->input('onboard_id');
        $comment = $request->input('comment');
        #IS CHECKED
        $is_checked = $request->input('is_checked');
        $result = Subdivision::distinct()->whereHas('item.checked_item',function ($q) use ($is_checked) {
            $q->where('role_id','!=',0);
        })->get()->pluck('id');
        foreach ($result as $i ){
            if($is_checked[$i]){
                foreach ($is_checked[$i] as $ischecked){
                    wfstore_email($request_id,$ischecked,$comment,$it_category,$type_request);
                }
            }
        }

        $wf_check = count($is_checked[1])+count($is_checked[2])+count($is_checked[4])+count($is_checked[5]); #HITUNG JUMLAH ITEM YANG DICHECKLIST
        $wf_detail = CheckedItem::where('request_id',$request_id)->count(); #HITUNG JUMLAH ITEM YANG SUDAH DI CHECKLIST
        if($wf_check == $wf_detail){
            #REQUEST CLOSING
            $onrequest = OnRequest::find($request_id);
            $onrequest->delivery_date = Carbon::now();
            $onrequest->save();

            #ONBOARD CLOSING
            $onboard = Onboard::find($onboard_id);
            $onboard->board_date = Carbon::now();
            $onboard->save();

            sentemail(4,$request_id,'');
        }
        Session::flash('flash_message', 'Users proceed has been done!');
        return redirect('ListOnBoard');
    }
}
