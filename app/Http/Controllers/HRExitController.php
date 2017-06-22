<?php

namespace App\Http\Controllers;

use App\ClearedItem;
use App\Onboard;
use App\OnboardItem;
use App\Subdivision;
use App\Workflow;
use App\WorkflowDetail;
use App\OnRequest;
use App\RoleUser;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\OnboardController;

class HRExitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $hr_column = "Exit Date";
        $exit_column = "Clear. Date";
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
        return view('listhr', compact('list','now','url','hr_column','exit_column','title'));
    }
    public function hrexit($onboard_id){

        $detail = Onboard::with('company','division','workplace','position')->where('id',$onboard_id)->first();
        #MASTER ONBOARD
        $result = Subdivision::distinct()->whereHas('item.suggested_list',function ($q) use ($detail) {})->get()->pluck('id');
        foreach ($result as $i) {
            $suggested[$i] = suggested_detail($onboard_id,'','',$i);
        }

        return view('exitform',compact('detail','suggested'));
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

        #CREATE WORKFLOW FROM TEAM IT
        $itcat_result = Subdivision::distinct()->has('item.suggested_list')->get()->pluck('id');
        foreach($itcat_result as $it_cat){
            $onboard->wfstore($req->id,$it_cat,'');
        }
        #SENT EMAIL TO ALL TEAM IT
        sentemail(5,$req->id,'');

        Session::flash('flash_message', 'New Exit Employee Request succesfully added!');
        return redirect()->action('HRExitController@index');
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
        foreach ($is_checked as $isc )
        {
            wfstore_email($request_id,$isc,'',$it_category,$type_request);
        }
        #UPDATE DATE COMPLETED
        Workflow::where('id',$checker->id)->update(['comment'=>$comment,'completed_by'=>Auth::user()->id,'completed_at'=>Carbon::now()]);
        $check_onboard = OnboardItem::where('onboard_id',$onboard_id)->count();
        $check_cleared = ClearedItem::where('onboard_id',$onboard_id)->count();
        if($check_onboard == $check_cleared)
        {
            Onboard::where('id',$onboard_id)->update(['exit_date'=>Carbon::now(),'updated_by'=>Auth::user()->id]); #UNTUK UPDATE SISTEM EXIT DATE
            sentemail(2,$request_id,''); #EMAIL TO REVIEWER
            #REMOVE USERS
            $result = Users::where('employee_id',$onboard_id)->first();
            if($result) {
                $user = User::find($result['id']);
                $user->detachRole(6);
                $user->delete();
            }
        }

        Session::flash('flash_message', 'IT Area stage has been proceed!');
        return redirect()->action('HRExitController@index');
    }
    #END IT ADMIN
}
