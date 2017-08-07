<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $result = RoleUser::with('roles','users')->where('role_id','!=',1)->get();

        return view('admin.listrole', compact('result'));
    }
    public function create()
    {
        $roles = Role::pluck('display_name','id');
        $users = User::pluck('name','id');

        return view('admin.addrole',compact('roles','users'));
    }
    public function store(Request $request)
    {
        $users = User::find($request->input('user_id'));
        $users->attachRole($request->input('role_id'));

        Session::flash('flash_message', 'New Role User succesfully added!');
        return redirect('manage-role');
    }
    public function destroy(Request $request,$user_id){
        $users = User::find($user_id);
        $users->detachRole($request->role);

        Session::flash('flash_message', 'Role User succesfully removed!');
        return redirect('manage-role');
    }
}
