<?php

namespace App\Http\Controllers\Master;

use App\Onboard;
use App\Holding;
use App\Position;
use App\Workplace;
use App\Grade;
use App\Subdivision;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Regulus\ActivityLog\Models\Activity;
use Yajra\Datatables\Datatables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('master.listemp', compact('list'));
    }
    public function show($onboard_id){
        $detail = Onboard::with('company','division','workplace','position')->where('id',$onboard_id)->first();
        $activity = Activity::where('content_id',$detail->id)->where('content_type','Onboard')->get();
        #MASTER ONBOARD
        $result = Subdivision::distinct()->whereHas('item.employee_item',function ($q) use ($detail) {
            $q->where('role_id','!=',0);
        })->get()->pluck('name','id');
        foreach ($result as $i=>$subdiv) {
            $suggested[$i] = suggested_detail('',$onboard_id,'',$i);
        }

        return view('master.viewemp',compact('detail','result','suggested','activity'));
    }
    public function dataEmployee(){
        $list = Onboard::with('company','position')->get();

        return Datatables::of($list)->
            addColumn('action',function ($lists){
            return '<a href="'.url('employee/'.$lists->id.'/edit').'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })->editColumn('status',function ($lists) {
            if ($lists->clearance_date)
                return 'Already Resign';
            elseif(statusWorkflow($lists->id))
                return statusWorkflow($lists->id);
            else
                return '<a href="'.url('hrexit/'.$lists->id).'"><i class="ace-icon fa fa-sign-out bigger-120"></i> Exit</a>';
        })->setRowClass(function($lists){
            if ($lists->clearance_date)
                return "btn-success";
            elseif(statusWorkflow($lists->id))
                return "btn-warning";
            else return '';
        })->make(true);
    }
    #TRIAL EDIT HRFORM
    public function edit($onboard_id){
        $request = Onboard::with('company')->where('id',$onboard_id)->first(); #DATA TRANSAKSI (REQUEST)
        $holding = Holding::pluck('name','id');
        $position = Position::pluck('name','id');
        $workplace = Workplace::pluck('name','id');
        $grade = Grade::pluck('name','id');

        return view('hrdetail', compact('request','holding','position','workplace','grade'));
    }
    public function update(Request $request, $onboard_id){

        #OLD VALUE
        $update_onboard = Onboard::find($onboard_id);
        $old_division_name = $update_onboard->getOriginal('division_name');
        $old_subdivision_name = $update_onboard->getOriginal('subdivision_name');
        $old_title = $update_onboard->getOriginal('title');
        $old_position_id = $update_onboard->getOriginal('position_id');
        $old_request_name = $update_onboard->getOriginal('request_name');
        $old_request_email = $update_onboard->getOriginal('request_email');
        $old_company_id = $update_onboard->getOriginal('company_id');
        $old_grade_id = $update_onboard->getOriginal('grade_id');
        $old_workplace_id = $update_onboard->getOriginal('workplace_id');

        $update_onboard->name = $request->input('onboardName');
        $update_onboard->division_id = 0;
        $update_onboard->division_name = $request->input('division_name');
        $update_onboard->subdivision_id = 0;
        $update_onboard->subdivision_name = $request->input('subdivision_name');
        $update_onboard->title = $request->input('title');
        $update_onboard->position_id = $request->input('position_id');
        $update_onboard->request_name = $request->input('request_name');
        $update_onboard->request_email = $request->input('request_email');
        $update_onboard->company_id = $request->input('onboardCompany');
        $update_onboard->grade_id = $request->input('grade_id');
        $update_onboard->workplace_id = $request->input('onboardWP');
        $update_onboard->updated_by = Auth::user()->name;
        $update_onboard->save();

        #CHECKING DATA
        if($old_division_name != $update_onboard->division_name) {
            $details = $old_division_name."=>".$update_onboard->division_name;
            activity_log($update_onboard->id,'Onboard','Division',$details,1);
        }
        if($old_subdivision_name != $update_onboard->subdivision_name) {
            $details = $old_subdivision_name."=>".$update_onboard->subdivision_name;
            activity_log($update_onboard->id,'Onboard','Department',$details,1);
        }
        if($old_title != $update_onboard->title) {
            $details = $old_title."=>".$update_onboard->title;
            activity_log($update_onboard->id,'Onboard','Title',$details,1);
        }
        if($old_position_id != $update_onboard->position_id) {
            $details = $old_position_id."=>".$update_onboard->position_id;
            activity_log($update_onboard->id,'Onboard','Position',$details,1);
        }
        if($old_request_name != $update_onboard->request_name) {
            $details = $old_request_name."=>".$update_onboard->request_name;
            activity_log($update_onboard->id,'Onboard','Request Name',$details,1);
        }
        if($old_request_email != $update_onboard->request_email) {
            $details = $old_request_email."=>".$update_onboard->request_email;
            activity_log($update_onboard->id,'Onboard','Request Email',$details,1);
        }
        if($old_company_id != $update_onboard->company_id) {
            $details = $old_company_id."=>".$update_onboard->company_id;
            activity_log($update_onboard->id,'Onboard','Company',$details,1);
        }
        if($old_grade_id != $update_onboard->grade_id) {
            $details = $old_grade_id."=>".$update_onboard->grade_id;
            activity_log($update_onboard->id,'Onboard','Grade',$details,1);
        }
        if($old_workplace_id != $update_onboard->workplace_id) {
            $details = $old_workplace_id."=>".$update_onboard->workplace_id;
            activity_log($update_onboard->id,'Onboard','Workplace',$details,1);
        }

        Session::flash('flash_message', 'Update Onboard succesfully added!');
        return redirect('employee');
    }
    #END TRIAL EDIT HRFORM
}
