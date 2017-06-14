<?php

namespace App\Http\Controllers;

use App\CheckedItem;
use App\ClearedItem;
use App\Company;
use App\Division;
use App\Position;
use App\Subdivision;
use App\OnboardItem;
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

        $company = Company::pluck('name','id');
        $divisi = Division::pluck('name','id');
        $position = Position::pluck('name','id');
        $workplace = Workplace::pluck('name','id');

        return view('hrform',compact('company','divisi','position','workplace')); #'subdivision',
    }
    public function store(Request $request){
        $this->validate($request, [
            'onboardName' => 'required','onboardCompany' => 'required',
            'onboardDivision' => 'required','onboardJoindate' => 'required',
            'position_id' => 'required'
        ]);

        //INPUT TO REGISTER (ONBOARD)
        $input = array('name'=>$request->request->get('onboardName'),
            'division_id'=>$request->request->get('onboardDivision'),
            'position_id'=>$request->request->get('position_id'),'subdivision_id'=>$request->request->get('subdivision_id'),
            'company_id'=>$request->request->get('onboardCompany'),'joindate'=>$request->request->get('onboardJoindate'),
            'workplace_id'=>$request->request->get('onboardWP'),'created_by'=>Auth::user()->name);
        $result = Onboard::create($input);

        #INPUT TO REQUEST WHERE STATUS = JOIN
        $req = new OnRequest();
        $req->onboard_id = $result['id'];
        $req->request_date = Carbon::now();
        $req->request_by = Auth::user()->id;
        $req->ticket = Str::random(4);
        $req->save();

        #CREATE WORKFLOW AS PER REQUEST (DIVISION IT=1)
        $itcat_result = Subdivision::where('division_id',1)->get();
        foreach($itcat_result as $it_cat){
            $this->wfstore($result['id'],$it_cat->id,'');
        }
        //SEND EMAIL
        sentemail(1,$result['id'],$result['name']);

        Session::flash('flash_message', 'New Employee Onboarding succesfully added!');
        return redirect()->action('ListboardController@index');
    }
    #START IT ADMIN
    public function itadm($onboardId)
    {
        $req = OnRequest::where('id',$onboardId)->first();
        $detail = Onboard::with('company','division','subdivision','workplace','position')->where('id',$req['onboard_id'])->first();

        $type_request = $req->type_request;
        $holding_id = $detail['company']['holdingId'];
        $company_id = $detail['company_id'];
        $division_id = $detail['division_id'];
        $position_id = $detail['position_id'];

        #UNTUK AMBIL DATA LIST ITEM
        if($type_request == 'join')
        {
            $list = PreparedItem::where('request_id',$onboardId)->get()->pluck('item_id')->toArray();

            $suggested = suggested_list(1,$holding_id,$company_id,$division_id,$position_id);
            $infra = suggested_list(2,$holding_id,$company_id,$division_id,$position_id);
            $apps = suggested_list(3,$holding_id,$company_id,$division_id,$position_id);
        }
        else
        {
            #DATA CHECKED ITEM
            $list = ClearedItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();

            $suggested = suggested_detail($req['onboard_id'],'','',1);
            $infra = suggested_detail($req['onboard_id'],'','',2);
            $apps = suggested_detail($req['onboard_id'],'','',3);
        }

        return view('admform',compact('req','detail','suggested','infra','apps','list'));
    }
    #TRIAL ALL TEAM IT USING THIS CONTROLLER
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
            #INPUT TO SYSWF
            $this->wfstore($request_id,$it_category,$comment);

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
            #INPUT TO SYSWF
            $this->wfstore($request_id,$it_category,$comment);
            #EMAIL TO REVIEWER
            sentemail(2,$request_id,'');
        }
        #END CHECK WORKFLOW

        if($it_category == 2){
            #CREATE USERS & UPDATE EMAIL
            $users = Onboard::where('id',$onboard_id)->first();
            $emails = $request->input('email');
            if ($users['email']==null){
                $this->validate($request, ['email' => 'required|email|unique:users']);

                #CREATE EMAIL
                $cr_users = new User();
                $cr_users->name = $users->name;
                $cr_users->email = $emails;
                $cr_users->password = bcrypt('123456');
                $cr_users->save();
                #CREATE ROLE USER
                $cr_users->attachRole(6);
                Onboard::where('id',$onboard_id)->update(['email'=>$emails]);
            }
        }

        Session::flash('flash_message', 'IT Area stage has been proceed!');
        return redirect()->action('ListboardController@index');
    }
    #START IT INFRA
    public function itinf($onboardId)
    {
        $req = OnRequest::where('id',$onboardId)->first();
        $detail = Onboard::with('company','division','workplace','position')->where('id',$req['onboard_id'])->first();
        $type_request = $req->type_request;

        $holding_id = $detail['company']['holdingId'];
        $company_id = $detail['company_id'];
        $division_id = $detail['division_id'];
        $position_id = $detail['position_id'];

        #UNTUK AMBIL DATA LIST ITEM
        if($type_request == 'join')
        {
            $list = PreparedItem::where('request_id',$onboardId)->get()->pluck('item_id')->toArray();

            $suggested = suggested_list(1,$holding_id,$company_id,$division_id,$position_id);
            $infra = suggested_list(2,$holding_id,$company_id,$division_id,$position_id);
            $apps = suggested_list(3,$holding_id,$company_id,$division_id,$position_id);
        }
        else
        {
            #DATA CHECKED ITEM
            $list = ClearedItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();

            $suggested = suggested_detail($req['onboard_id'],'','',1);
            $infra = suggested_detail($req['onboard_id'],'','',2);
            $apps = suggested_detail($req['onboard_id'],'','',3);
        }

        return view('infraform',compact('req','detail','suggested','infra','apps','list'));
    }
    #START IT APPS
    public function itapp($onboardId)
    {
        $req = OnRequest::where('id',$onboardId)->first();
        $detail = Onboard::with('company','division','workplace','position')->where('id',$req['onboard_id'])->first();

        $type_request = $req->type_request;
        $holding_id = $detail['company']['holdingId'];
        $company_id = $detail['company_id'];
        $division_id = $detail['division_id'];
        $position_id = $detail['position_id'];

        #UNTUK AMBIL DATA LIST ITEM
        if($type_request == 'join')
        {
            $list = PreparedItem::where('request_id',$onboardId)->get()->pluck('item_id')->toArray();

            $suggested = suggested_list(1,$holding_id,$company_id,$division_id,$position_id);
            $infra = suggested_list(2,$holding_id,$company_id,$division_id,$position_id);
            $apps = suggested_list(3,$holding_id,$company_id,$division_id,$position_id);
        }
        else
        {
            #DATA CHECKED ITEM
            $list = ClearedItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();

            $suggested = suggested_detail($req['onboard_id'],'','',1);
            $infra = suggested_detail($req['onboard_id'],'','',2);
            $apps = suggested_detail($req['onboard_id'],'','',3);
        }

        return view('appsform',compact('req','detail','suggested','infra','apps','list'));
    }
    #CHECKER AREA
    public function reviewer($request_id)
    {
        $req = OnRequest::where('id',$request_id)->first();
        if ($req)  {
            $detail = Onboard::with('company','division','workplace','position')->where('id',$req['onboard_id'])->first(); }

        #DATA ITEM WITH REQUEST TYPE (JOIN, EXIT)
        if($req->type_request == 'join'){
            #DATA CHECKED ITEM
            $checker = CheckedItem::where('request_id',$request_id)->get()->pluck('item_id')->toArray();

            $suggested = suggested_detail('',$request_id,'review',1);
            $infra = suggested_detail('',$request_id,'review',2);
            $apps = suggested_detail('',$request_id,'review',3);
        } else {
            #DATA CHECKED ITEM
            $checker = ClearedItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();

            $suggested = suggested_detail($req['onboard_id'],'','',1);
            $infra = suggested_detail($req['onboard_id'],'','',2);
            $apps = suggested_detail($req['onboard_id'],'','',3);
        }

        for($i=1;$i<=3;$i++){
            $wf_comment[$i] = Workflow::where('request_id',$request_id)->where('it_category',$i)->first();
        }
        return view('reviewer',compact('req','detail','suggested','infra','apps','checker','wf_comment'));
    }
    public function createstore(Request $request)
    {
        #MASTER ONBOARD
        $it_category = $request->input('it_category');
        $type_request = $request->input('type_request');

        $request_id = $request->input('id');
        $comment = $request->input('comment');
        #IT TEAM
        $admin = $request->input('admin');
        $infra = $request->input('infra');
        $apps = $request->input('apps');

        #START CHECK WORKFLOW
        $checker = Workflow::where('request_id',$request_id)->where('it_category',$it_category)->first();
        if($request->input('submit'))
        {
            #EMAIL TO REVIEWER
            $wf_check = count($admin)+count($infra)+count($apps); #HITUNG JUMLAH ITEM YANG DICHECKLIST
            $wf_detail = CheckedItem::where('request_id',$request_id)->count(); #HITUNG JUMLAH ITEM YANG SUDAH DI CHECKLIST
            #LOOP PREPARED ITEM & WORKFLOW DETAIL
            if($wf_check > $wf_detail) {
                if($admin){
                    foreach ($admin as $itadm){
                        wfstore_email($request_id,$itadm,$comment,$it_category,$type_request);
                    }
                }
                if($infra) {
                    foreach ($infra as $inf){
                        wfstore_email($request_id,$inf,$comment,$it_category,$type_request);
                    }
                }
                if($apps){
                    foreach ($apps as $app){
                        wfstore_email($request_id,$app,$comment,$it_category,$type_request);
                    }
                }
                sentemail(3,$request_id,'');
            }
        }
        if($request->input('completed'))
        {
            #LOOP PREPARED ITEM & WORKFLOW DETAIL
            if($admin){
                foreach ($admin as $itadm){
                    wfstore_email($request_id,$itadm,$comment,$it_category,$type_request);
                }
            }
            if($infra) {
                foreach ($infra as $inf){
                    wfstore_email($request_id,$inf,$comment,$it_category,$type_request);
                }
            }
            if($apps){
                foreach ($apps as $app){
                    wfstore_email($request_id,$app,$comment,$it_category,$type_request);
                }
            }
            #UPDATE DATE COMPLETED
            Workflow::where('id',$checker['id'])->update(['completed_by'=>Auth::user()->id,'completed_at'=>Carbon::now()]);
            #INPUT TO SYSWF
            $this->wfstore($request_id,$it_category,$comment);
            #EMAIL TO REVIEWER
            sentemail(3,$request_id,'');
        }
        #END CHECK WORKFLOW

        Session::flash('flash_message', 'Reviewer proceed has been done!');
        return redirect()->action('ListboardController@index');
    }
    #USERS AREA
    public function userview($request_id)
    {
        $req = OnRequest::where('id',$request_id)->first();
        if ($req)  {
            $detail = Onboard::with('company','division','workplace','position')->where('id',$req['onboard_id'])->first();
        }
        $type_request = $req->type_request;

        $employee = OnboardItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();
        #MASTER ONBOARD
        if($type_request == 'join'){
            $suggested = suggested_detail('',$request_id,'',1);
            $infra = suggested_detail('',$request_id,'',2);
            $apps = suggested_detail('',$request_id,'',3);
        } else
        {
            $suggested = suggested_detail($req['onboard_id'],'','',1);
            $infra = suggested_detail($req['onboard_id'],'','',2);
            $apps = suggested_detail($req['onboard_id'],'','',3);
        }

        $wf_comment = Workflow::where('request_id',$request_id)->where('it_category',4)->first();
        $us_comment = Workflow::where('request_id',$request_id)->where('it_category',5)->first();

        #CHECK IS ADMIN
        if(Auth::user()->hasRole('admin')){
            return view('useradmin',compact('req','detail','suggested','infra','apps','employee','wf_comment','us_comment')); #
        } else {
            return view('userview',compact('req','detail','suggested','infra','apps','employee','wf_comment','us_comment')); #
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
        #IT TEAM
        $admin = $request->input('admin');
        if($admin){
            foreach ($admin as $itadm){
                wfstore_email($request_id,$itadm,$comment,$it_category,$type_request);
            }
        }
        $infra = $request->input('infra');
        if($infra){
            foreach ($infra as $inf){
                wfstore_email($request_id,$inf,$comment,$it_category,$type_request);
            }
        }
        $apps = $request->input('apps');
        if ($apps)
        {
            foreach ($apps as $app){
                wfstore_email($request_id,$app,$comment,$it_category,$type_request);
            }
        }

        $wf_check = count($admin)+count($infra)+count($apps); #HITUNG JUMLAH ITEM YANG DICHECKLIST
        $wf_detail = CheckedItem::where('request_id',$request_id)->count(); #HITUNG JUMLAH ITEM YANG SUDAH DI CHECKLIST
        if($wf_check == $wf_detail){
            $onrequest = OnRequest::find($request_id);
            $onrequest->delivery_date = Carbon::now();
            $onrequest->save();

            sentemail(4,$request_id,'');
        }
        Session::flash('flash_message', 'Users proceed has been done!');
        return redirect()->action('ListboardController@index');
    }
}