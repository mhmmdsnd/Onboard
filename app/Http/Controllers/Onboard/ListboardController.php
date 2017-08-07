<?php

namespace App\Http\Controllers\Onboard;

use App\CheckedItem;
use App\Company;
use App\OnRequest;
use App\PreparedItem;
use App\RoleUser;
use App\Subdivision;
use App\SuggestedList;
use App\Workflow;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ListboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hr_column = "Delv. Date";
        $join_column = "Join Date";
        $exit_column = "Req Date";
        $title = "join";
        $now = Carbon::now()->toDateString();
        $role = RoleUser::where('user_id',Auth::user()->id)->pluck('role_id')->first();
        if($role == 2) $url = "ITAdm";
        elseif ($role == 3) $url = "ITInfra";
        elseif ($role == 4) $url = "ITApps";
        elseif ($role == 6) $url = "users";
        elseif ($role == 7) $url = "ga-detail";
        else $url = "users";

        #CHECK LIST HR BERDASARKAN ROLE
        if ($role == 6) {
            $list = OnRequest::with('onboard.company','onboard.division')->whereHas('onboard',function ($q) use ($url) {
                $q->where('email',Auth::user()->email);
            })->where('type_request','join')->orderby('created_at','asc')->get();
        } else {
            $list = OnRequest::with('onboard.company','onboard.division')->where('type_request','join')->orderby('created_at','asc')->get();
        }

        return view('listhr', compact('list','now','url','hr_column','join_column','exit_column','title'));
    }
    public function show(){
        $input = Input::get('option');
        $subdivision = Subdivision::where('division_id',$input)->pluck('name','id');
        return Response::make($subdivision);
    }
    public function showcompany()
    {
        $input = Input::get('group');
        $company = Company::where('holdingid',$input)->pluck('name','id');
        return Response::make($company);
    }
    public function usermail()
    {
        $input = User::all()->where('email', Input::get('email'))->first();
        if ($input) {
            return Response::json('1'); #Input::get('email').' is already taken'
        } else {
            return Response::json('0'); #Response::json(Input::get('email').' is available');
        }
    }
    #FUNCTION UNTUK SLA REPORT
    public function slareport()
    {
        #$result = null;
        $division = Subdivision::distinct()->has('item.suggested_list')->where('role_id','!=',0)->get()->pluck('name','id');
        $division_id = null;
        return view('report.onboardreport',compact('division','division_id'));
    }
    public function generatesla(Request $request)
    {
        $startdate = date('Y-m-d',strtotime($request->input('start_date')));
        $enddate = date('Y-m-d',strtotime($request->input('end_date')));

        $result = Subdivision::distinct()->has('item.suggested_list')->where('id','!=','12')->get()->pluck('name','id');
        foreach ($result as $key=>$value){

            $average[$key] = DB::table('request')->join("workflow",'workflow.request_id','=','request.id')
                ->select(DB::raw("avg(datediff(completed_at,request_date)) as total "))
                ->where("it_category",$key)->get();

            $minimum[$key] = DB::table('request')->join("workflow",'workflow.request_id','=','request.id')
                ->select(DB::raw("min(datediff(completed_at,request_date)) as total "))
                ->where("it_category",$key)->get();

            $maximum[$key] = DB::table('request')->join("workflow",'workflow.request_id','=','request.id')
                ->select(DB::raw("max(datediff(completed_at,request_date)) as total "))
                ->where("it_category",$key)->get();

            $progress[$key] = OnRequest::whereHas('workflow',function ($q) use ($key) {
                $q->whereNull('completed_at')->where('it_category',$key);
            })->whereBetween('request_date',array($startdate,$enddate))->count();

            $prepared[$key] = CheckedItem::whereHas('item', function ($q) use ($key) {
                $q->where('subdivision_id',$key);
            })->whereHas('request', function ($qr) use ($startdate,$enddate) {
                $qr->whereBetween('request_date',array($startdate,$enddate));
            })->count();

            $completed[$key] = OnRequest::whereHas('workflow',function ($q) use ($key) {
                $q->whereNotNull('completed_at')->where('it_category',$key);
            })->whereBetween('request_date',array($startdate,$enddate))->count();
        }

        $total = OnRequest::where('type_request','join')->whereBetween('request_date',array($startdate,$enddate))->count();

        return view('report.slareport',compact('result','average','minimum','maximum','progress','prepared','completed','total'));
    }
    public function generateonboard(Request $request)
    {
        $startdate = date('Y-m-d',strtotime($request->input('start_date')));
        $enddate = date('Y-m-d',strtotime($request->input('end_date')));
        $division_id = $request->input('division_id');

        #HEADER
        #TOTAL = PENDING + COMPLETED
        $pending = OnRequest::whereHas('workflow',function ($q) use ($division_id) { $q->whereNull('completed_at')->where('it_category',$division_id);
        })->whereBetween('request_date',array($startdate,$enddate))->count();
        $completed = OnRequest::whereHas('workflow',function ($q) use ($division_id) { $q->whereNotNull('completed_at')->where('it_category',$division_id);
        })->whereBetween('request_date',array($startdate,$enddate))->count();
        $total = $pending + $completed;
        #COMPLETION TERMS
        $avg_terms = DB::table('request')->join("workflow",'workflow.request_id','=','request.id')
            ->select(DB::raw("avg(datediff(completed_at,request_date)) as total "))
            ->where("it_category",$division_id)->first();

        $min_terms = DB::table('request')->join("workflow",'workflow.request_id','=','request.id')
            ->select(DB::raw("min(datediff(completed_at,request_date)) as total "))
            ->where("it_category",$division_id)->first();

        $max_terms = DB::table('request')->join("workflow",'workflow.request_id','=','request.id')
            ->select(DB::raw("max(datediff(completed_at,request_date)) as total "))
            ->where("it_category",$division_id)->first();

        #LIST ITEM DETAIL
        $list_item = PreparedItem::whereHas('item.subdivision',function ($q) use ($division_id) {
            $q->where('subdivision_id',$division_id); })->distinct()->groupby('item_id')->get();
        foreach ($list_item as $list=>$value){
            $complete[$list] = $this->countWorkflow($division_id,$value->item_id,'');
            $average[$list] = $this->countWorkflow($division_id,$value->item_id,'avg');
            $minimum[$list] = $this->countWorkflow($division_id,$value->item_id,'min');
            $maximum[$list] = $this->countWorkflow($division_id,$value->item_id,'max');
        }

        $division = Subdivision::distinct()->has('item.suggested_list')->where('role_id','!=',0)->get()->pluck('name','id'); #UNTUK AMBIL DATA DIVISION
        return view('report.onboardreport',compact('division','division_id','total','pending','completed','avg_terms'
            ,'min_terms','max_terms','list_item','complete','average','minimum','maximum'));
    }
    public function countWorkflow($division_id,$item_id,$type=null)
    {
        if($type){ $type_sql = $type."(datediff(prepared_item.created_at,request_date))"; }
        else { $type_sql = "count(item_id) "; }
        $count = DB::table('prepared_item')
            ->join("item",'prepared_item.item_id','=','item.id')->join("request",'prepared_item.request_id','=','request.id')
            ->select(DB::raw($type_sql." as total "))
            ->where("subdivision_id",$division_id)->where('item_id',$item_id)->first();
        return $count->total;
    }
    public function exportexcel(){
        $hr_column = "Delv. Date (in Days)";
        $exit_column = "Req Date";
        $now = Carbon::now()->toDateString();
        $role = RoleUser::where('user_id',Auth::user()->id)->pluck('role_id')->first();

        #CHECK LIST HR BERDASARKAN ROLE
        $list = OnRequest::with('onboard.company','onboard.division','onboard.workplace')->where('type_request','join')->orderby('created_at','asc')->get();
        $col_header = [];
        $col_header[] = ['Ticket ID#','Company','Grade','Name','Title','Request Name','Request Email','Join Date','Workplace',$exit_column,'IT Adm','IT Infra','HR Shared Serv','GA Dept',$hr_column];
        foreach ($list as $result){
            #DATE FORMAT
            $joindate = $result->onboard->joindate;
            $reqdate = \PHPExcel_Shared_Date::PHPToExcel($result->onboard->created_at);
            #CHECKING DATA AVAIL
            if ($result->onboard->company_id!='') {
                $holding = $result->onboard->company->holdingId;
                $company_name = $result->onboard->company->name;
            }
            else {
                $holding = '0';
                $company_name = "";
            }
            if($result->onboard->grade_id!="") $grade = $result->onboard->grade_id;
            else $grade = "";

            if($result->onboard->workplace_id) $workplace_name = $result->onboard->workplace->name;
            else $workplace_name = "";

            #FORMAT UNTUK TEAM WORKFLOW
            $it_admin = dateWorkflow($result->id,1,$holding,$result->onboard->company_id,$result->onboard->division_id,$result->onboard->position_id);
            $it_infra = dateWorkflow($result->id,2,$holding,$result->onboard->company_id,$result->onboard->division_id,$result->onboard->position_id);
            $hr_shared = dateWorkflow($result->id,4,$holding,$result->onboard->company_id,$result->onboard->division_id,$result->onboard->position_id);
            $ga_dept = dateWorkflow($result->id,5,$holding,$result->onboard->company_id,$result->onboard->division_id,$result->onboard->position_id);

            #FORMAT UNTUK DELIVERY DATE
            if ($result->delivery_date){
                $status = \PHPExcel_Shared_Date::PHPToExcel($result->delivery_date);
            } elseif ($result->onboard->clearance_date){
                $status = "Exit";
            } else {
                if($result->type_request == "join") $status = Carbon::parse($now)->diffInDays(Carbon::parse($result->onboard->joindate),false);
            }
            $col_header[] = array($result->ticket,$company_name,$grade,$result->onboard->name,$result->onboard->title,$result->onboard->request_name,$result->onboard->request_email,$joindate,$workplace_name,$reqdate,$it_admin,$it_infra,$hr_shared,$ga_dept,$status);
        }

        Excel::create('ListOnBoard',function ($excel) use ($col_header){
            $excel->setTitle("List Onboard");
            $excel->setCreator(Auth::user()->name)->setCompany("GEMS");
            $excel->setDescription("List Onboard File");

            $excel->sheet('Onboarding',function ($sheet) use ($col_header) {
                $sheet->setColumnFormat(array('H'=>\PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY,
                    'J'=>\PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY));
                $sheet->fromArray($col_header,null,'A1',false,false);
            });
        })->download('xlsx');
    }

}
