<?php

namespace App\Http\Controllers;

use App\CheckedItem;
use App\Company;
use App\OnRequest;
use App\RoleUser;
use App\Subdivision;
use App\Workflow;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;

class ListboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hr_column = "Delv. Date";
        $exit_column = "Req Date";
        $title = "join";
        $now = Carbon::now();
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


        return view('listhr', compact('list','now','url','hr_column','exit_column','title'));
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
        $result = null;
        #$result = Subdivision::distinct()->has('item.suggested_list')->get()->pluck('name','id');
        return view('slareport',compact('result'));
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

        return view('slareport',compact('result','average','minimum','maximum','progress','prepared','completed','total'));
    }
}
