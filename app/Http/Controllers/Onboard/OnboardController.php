<?php

namespace App\Http\Controllers\Onboard;

use App\Http\Controllers\Controller;
use App\ClearedItem;
use App\RoleUser;
use App\Grade;
use App\Holding;
use App\Position;
use App\Subdivision;
use App\OnRequest;
use App\Onboard;
use App\PreparedItem;
use App\User;
use App\Workflow;
use App\WorkflowDetail;
use App\Workplace;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class OnboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    #START WORKFLOW
    public function wfstore($request_id, $itcat,$comment){

        $checker = Workflow::where('request_id',$request_id)->where('it_category',$itcat)->first();
        if ($checker == null){
            $wf = new Workflow();
            $wf->request_id = $request_id;
            $wf->user_id = Auth::user()->id;
            $wf->it_category = $itcat; #IT LEVEL REQUEST
            $wf->comment = $comment;
            $wf->created_by = Auth::user()->id;
        } else {
            $wf = Workflow::find($checker->id);
            $wf->user_id = Auth::user()->id;
            $wf->comment = $comment;
            $wf->updated_by = Auth::user()->id;
        }
        $wf->save();

    }
    #END WORKFLOW
    public function create(){

        $holding = Holding::pluck('name','id');
        $position = Position::pluck('name','id');
        $workplace = Workplace::pluck('name','id');
        $grade = Grade::pluck('name','id');

        return view('hrform',compact('holding','position','workplace','grade')); #'divisi','subdivision',
    }
    public function store(Request $request){
        //INPUT TO REGISTER (ONBOARD)
        $create_onboard = New Onboard();
        $create_onboard->name = $request->input('onboardName');
        $create_onboard->division_id = 0;
        $create_onboard->division_name = $request->input('division_name');
        $create_onboard->subdivision_id = 0;
        $create_onboard->subdivision_name = $request->input('subdivision_name');
        $create_onboard->title = $request->input('title');
        $create_onboard->position_id = $request->input('position_id');
        $create_onboard->request_name = $request->input('request_name');
        $create_onboard->request_email = $request->input('request_email');
        $create_onboard->company_id = $request->input('onboardCompany');
        $create_onboard->grade_id = $request->input('grade_id');
        $create_onboard->joindate = $request->input('onboardJoindate');
        $create_onboard->workplace_id = $request->input('onboardWP');
        $create_onboard->created_by = Auth::user()->name;
        $create_onboard->save();

        #INPUT TO REQUEST WHERE STATUS = JOIN
        $req = new OnRequest();
        $req->onboard_id = $create_onboard['id'];
        $req->request_date = Carbon::now();
        $req->request_by = Auth::user()->id;
        $req->ticket = Str::random(4);
        $req->created_by = Auth::user()->id;
        $req->save();

        #CREATE WORKFLOW AS PER REQUEST (DIVISION IT=1)
        $hasil = Subdivision::distinct()->where('role_id','!=',0)->get()->pluck('id');
        foreach ($hasil as $it_cat) {
            $this->wfstore($req['id'],$it_cat,' ');
        }
        //SEND EMAIL
        sentemail(1,$req->id,$create_onboard->id);

        Session::flash('flash_message', 'New Employee Onboarding succesfully added!');
        return redirect('ListOnBoard');
    }
    #START TRIAL ALL TEAM IT USING THIS CONTROLLER
    public function itstore(Request $request){
        #MASTER ONBOARD
        $it_category = $request->input('it_category');
        $type_request = $request->input('type_request');
        #MASTER ONBOARD
        $holding_id = $request->input('holding_id');
        $company_id = $request->input('company_id');
        $division_id = $request->input('division_id');
        $position_id = $request->input('position_id');

        $request_id = $request->request->get('id');
        $onboard_id = $request->input('onboard_id');
        $is_checked = $request->input('is_checked');
        $comment = $request->input('comment');

        $checker = Workflow::where('request_id',$request_id)->where('it_category',$it_category)->first();
        if($request->input('submit'))
        {
            #EMAIL TO REVIEWER
            $wf_check = count($is_checked); #HITUNG JUMLAH ITEM YANG DICHECKLIST
            $wf_detail = WorkflowDetail::whereHas('workflow',function ($q) use ($it_category) {
                $q->where('it_category',$it_category);
            })->where('workflow_id',$checker->id)->count(); #HITUNG JUMLAH ITEM YANG SUDAH DI CHECKLIST
            if($wf_check > $wf_detail) {
                #LOOP PREPARED ITEM & WORKFLOW DETAIL
                foreach ($is_checked as $isc )
                {
                    wfstore_detail($request_id,$isc,$it_category,$holding_id,$company_id,$division_id,$position_id);
                }
                sentemail(2,$request_id,'');
            }
            $this->wfstore($request_id,$it_category,$comment);#INPUT TO SYSWF
        }
        if($request->input('completed'))
        {
            #LOOP PREPARED ITEM & WORKFLOW DETAIL
            foreach ($is_checked as $isc )
            {
                wfstore_detail($request_id,$isc,$it_category,$holding_id,$company_id,$division_id,$position_id);
            }
            #UPDATE DATE COMPLETED
            Workflow::where('id',$checker->id)->update(['completed_by'=>Auth::user()->id,'completed_at'=>Carbon::now()]);
            $this->wfstore($request_id,$it_category,$comment);#INPUT TO SYSWF
            sentemail(2,$request_id,'');#EMAIL TO REVIEWER
        }
        #END CHECK WORKFLOW

        if($it_category == 2){
            #CREATE USERS & UPDATE EMAIL
            $users = Onboard::where('id',$onboard_id)->first();
            $emails = strtolower($request->input('email')); #update per 13/7
            if ($users['email']==null){
                $this->validate($request, ['email' => 'required|email|unique:users']);

                #CREATE EMAIL
                $cr_users = new User();
                $cr_users->name = $users->name;
                $cr_users->email = $emails;
                $cr_users->password = bcrypt('123456');
                $cr_users->employee_id = $onboard_id; #penambahan employee id (untuk mendapatkan data divisi)
                $cr_users->save();
                #CREATE ROLE USER
                $cr_users->attachRole(6);
                Onboard::where('id',$onboard_id)->update(['email'=>$emails]);
            }
        }

        Session::flash('flash_message', 'IT Area stage has been proceed!');
        return redirect('ListOnBoard');
    }
    public function itdetail($onboardId)
    {
        #DATA ROLE BERDASARKAN USER LOGIN
        $role = RoleUser::with('roles','subdivision')->where('user_id',Auth::user()->id)->first();
        if($role->role_id == 2) $url = "ITAdm";
        elseif ($role->role_id == 3) $url = "ITInfra";
        elseif ($role->role_id == 4) $url = "ITApps";
        elseif ($role->role_id == 5) $url = "hr-detail";
        elseif ($role->role_id == 7) $url = "ga-detail";
        else $url = "users";
        #UNTUK CHECK SOAL ADMIN ATAU BUKAN
        if($role->role_id != 1) $it_category = $role->subdivision->id;
        else $it_category = $role->role_id;

        $req = OnRequest::where('id',$onboardId)->first(); #DATA TRANSAKSI (REQUEST)
        $detail = Onboard::with('company','division','subdivision','workplace','position')->where('id',$req['onboard_id'])->first(); #DATA EMPLOYEE
        $workflow = Workflow::where('request_id',$onboardId)->where('it_category',$it_category)->first(); #DATA WORKFLOW
        #UNTUK PENGECEKAN DATA KONFIGURASI SUGGESTED DETAIL
        $type_request = $req->type_request;
        $holding_id = $detail['company']['holdingId'];
        $company_id = $detail['company_id'];
        $division_id = $detail['division_id'];
        $position_id = $detail['position_id'];

        #UNTUK AMBIL DATA LIST ITEM
        if($type_request == 'join')
        {
            $list = PreparedItem::where('request_id',$onboardId)->get()->pluck('item_id')->toArray();
            #TRIAL LOOP SUGGESTED LIST BERDASARKAN SUBDIVISION
            $result = Subdivision::distinct()->whereHas('item.suggested_list',function ($q) use ($division_id) {
                $q->where('role_id','!=','0');
            })->get(['role_id','name','id']);
            foreach ($result as $i){
                $suggested[$i->id] = suggested_list($i->id,$holding_id,$company_id,$division_id,$position_id);
            }
        }
        else
        {
            #DATA CHECKED ITEM
            $list = ClearedItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();
            $result = Subdivision::distinct()->whereHas('item.employee_item',function ($q) use ($req) {
                $q->where('role_id','!=','0')->where('onboard_id',$req['onboard_id']);
            })->get(['role_id','name','id']);
            foreach ($result as $i){
                $suggested[$i->id] = suggested_detail($req['onboard_id'],'','',$i->id);
            }
        }

        return view('itform',compact('req','detail','role','result','suggested','list','url','workflow'));
    }
    #END TRIAL
}