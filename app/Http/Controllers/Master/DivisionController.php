<?php

namespace App\Http\Controllers\Master;

use App\Item;
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

        /*$user = User::find('24');
        $user->detachRole(4);*/

        /*$user = User::find('24');
        $user->attachRole(4);*/
        /*$user = User::find('10');
        $user->detachRole(5);*/

        /*$user = User::find('10');
        $user->attachRole(5);*/

        $division_id = 1;
        $subdivision = Subdivision::distinct()->whereHas('item.suggested_list',function ($q) use ($division_id) {})->get()->pluck('id');

        dd($subdivision);
    }
}
