<?php

namespace App\Http\Controllers\Master;

use App\Onboard;
use App\OnboardItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $list = Onboard::with('company','position')->get();

        return view('master.listemp', compact('list'));
    }
    public function show($onboard_id){
        $detail = Onboard::with('company','division','workplace','position')->where('id',$onboard_id)->first();
        $employee = OnboardItem::where('onboard_id',$onboard_id)->get()->pluck('item_id')->toArray();

        #MASTER ONBOARD
        $suggested = suggested_detail('',$onboard_id,'',1);
        $infra = suggested_detail('',$onboard_id,'',2);
        $apps = suggested_detail('',$onboard_id,'',3);

        return view('master.viewemp',compact('detail','suggested','infra','apps','employee'));
    }
}
