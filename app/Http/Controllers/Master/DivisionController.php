<?php

namespace App\Http\Controllers\Master;

use Adldap\Laravel\Facades\Adldap;
use App\Item;
use App\RoleUser;
use App\Subdivision;
use App\SuggestedList;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    //
    public function index()
    {
        $url = url("/"); #URL BY REQUEST
        $id = 6;
        $name = "Administrator";
        #$sent = Subdivision::distinct()->with('roleuser')->where('role_id','=',3)->get();
        $sent = RoleUser::with('users')->whereIn('role_id',[2,3,5,7,8,10])->where('user_id','!=',1)->get();
        foreach ($sent as $input){
            print_r($input->users->name);
            /*if($input->role_id == 2) $url_role = "ITAdm";
            elseif ($input->role_id == 3) $url_role = "ITInfra";
            elseif ($input->role_id == 4) $url_role = "ITApps";
            elseif ($input->role_id == 5) $url_role = "hr-detail";
            elseif ($input->role_id == 7) $url_role = "ga-detail";
            else $url_role = "users";
            $input = array_add($input,'name',$name);
            $data_mail = array(
                'itname' => $input->roleuser->users,
                'name' => $name,'request_id' => $id,
                'user_type' =>$url_role,
                'url'=>$url, 'type_request'=>'join'
            );*/
            try{
                #echo $input->roleuser->users->name ."<br>";
                /* Mail::send('emails.emails',['data'=>$data_mail],function ($m) use ($input) {
                    if (!config('mail.to')){
                        #$m->to($input['roleuser']['users']['email'], $input['roleuser']['users']['name']);
                    }
                    $m->subject('New Employee OnBoarding : '.$input['name']);
                });*/
            } catch (\Exception $error){
                #echo $error;
            }

            #print_r($data_mail);
        }
    }
}
