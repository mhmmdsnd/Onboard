<?php

namespace App\Http\Controllers;

use App\OnRequest;
use App\RoleUser;
use App\Subdivision;
use Carbon\Carbon;
use App\User;
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
        $hr_column = "Delivered Date";
        $exit_column = "Request Date";
        $title = "join";
        $now = Carbon::now();
        $role = RoleUser::where('user_id',Auth::user()->id)->pluck('role_id')->first();
        if($role == 2) $url = "ITAdm";
        elseif ($role == 3) $url = "ITInfra";
        elseif ($role == 4) $url = "ITApps";
        elseif ($role == 5) $url = "Review";
        elseif ($role == 6) $url = "Users";
        else $url = "Users";

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
    public function usermail()
    {
        $input = User::all()->where('email', Input::get('email'))->first();
        if ($input) {
            return Response::json('1'); #Input::get('email').' is already taken'
        } else {
            return Response::json('0'); #Response::json(Input::get('email').' is available');
        }
    }
}
