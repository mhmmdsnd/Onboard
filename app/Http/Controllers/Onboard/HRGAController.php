<?php

namespace App\Http\Controllers\Onboard;

use Illuminate\Http\Request;
use App\OnRequest;
use App\ClearedItem;
use App\Onboard;
use App\PreparedItem;
use App\Subdivision;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HRGAController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

    }
    #START FUNCTION SHOW DATATABLES J1
    public function show($request_id)
    {
        $req = OnRequest::where('id',$request_id)->first();
        $detail = Onboard::with('company','division','workplace','position')->where('id',$req['onboard_id'])->first();

        $type_request = $req->type_request;
        $holding_id = $detail['company']['holdingId'];
        $company_id = $detail['company_id'];
        $division_id = $detail['division_id'];
        $position_id = $detail['position_id'];

        #UNTUK AMBIL DATA LIST ITEM
        if($type_request == 'join')
        {
            $list = PreparedItem::where('request_id',$request_id)->get()->pluck('item_id')->toArray();

            #TRIAL LOOP SUGGESTED LIST BERDASARKAN SUBDIVISION
            $result = Subdivision::distinct()->whereHas('item.suggested_list',function ($q) use ($division_id) {})->get()->pluck('id');
            foreach ($result as $subdivision){
                $suggested[$subdivision] = suggested_list($subdivision,$holding_id,$company_id,$division_id,$position_id);
            }
        }
        else
        {
            #DATA CHECKED ITEM
            $list = ClearedItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();
            $result = Subdivision::distinct()->whereHas('item.suggested_list',function ($q) use ($division_id) {})->get()->pluck('id');
            foreach ($result as $subdivision) {
                $suggested[$subdivision] = suggested_detail($req['onboard_id'],'','',$subdivision);
            }
        }

        return view('gaform',compact('req','detail','suggested','list'));
    }
    #END FOR GA DEPAT (LAST)
    #START FOR HR WIDGET
    public function hrshow($request_id){
        $req = OnRequest::where('id',$request_id)->first();
        $detail = Onboard::with('company','division','workplace','position')->where('id',$req['onboard_id'])->first();

        $type_request = $req->type_request;
        $holding_id = $detail['company']['holdingId'];
        $company_id = $detail['company_id'];
        $division_id = $detail['division_id'];
        $position_id = $detail['position_id'];

        #UNTUK AMBIL DATA LIST ITEM
        if($type_request == 'join')
        {
            $list = PreparedItem::where('request_id',$request_id)->get()->pluck('item_id')->toArray();

            #TRIAL LOOP SUGGESTED LIST BERDASARKAN SUBDIVISION
            $result = Subdivision::distinct()->whereHas('item.suggested_list',function ($q) use ($division_id) {})->get()->pluck('id');
            foreach ($result as $subdivision){
                $suggested[$subdivision] = suggested_list($subdivision,$holding_id,$company_id,$division_id,$position_id);
            }
        }
        else
        {
            #DATA CHECKED ITEM
            $list = ClearedItem::where('onboard_id',$req['onboard_id'])->get()->pluck('item_id')->toArray();
            $result = Subdivision::distinct()->whereHas('item.suggested_list',function ($q) use ($division_id) {})->get()->pluck('id');
            foreach ($result as $i) {
                $suggested[$i] = suggested_detail($req['onboard_id'],'','',$i);
            }
        }

        return view('hrselfform',compact('req','detail','suggested','list'));
    }
    #END FOR HR WIDGET
}
