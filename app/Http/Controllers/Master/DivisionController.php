<?php

namespace App\Http\Controllers\Master;

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
        /*$user = User::find('2');
        $user->attachRole(1);

        $user = User::find('2');
        $user->attachRole(2);

        $user = User::find('2');
        $user->attachRole(3);

        $user = User::find('2');
        $user->attachRole(4);

        $user = User::find('2');
        $user->attachRole(5);*/

        /*$user = User::find('10');
        $user->detachRole(5);

        $user = User::find('7');
        $user->detachRole(5);*/

        /*$user = User::find('28');
        $user->attachRole(5);*/

        $user = User::find('24');
        $user->detachRole(4);

        /*$user = User::find('24');
        $user->attachRole(4);*/
        /*$user = User::find('10');
        $user->detachRole(5);*/

        $user = User::find('10');
        $user->attachRole(5);

    }
}
