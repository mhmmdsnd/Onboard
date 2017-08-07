<?php

namespace App\Http\Controllers\Master;

use App\Company;
use App\Holding;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Regulus\ActivityLog\Models\Activity;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Company::with('holding')->paginate(10);

        return view('master.listcompany', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $holding = Holding::pluck('name','id');
        return view('master.addcompany',compact('holding'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = New Company();
        $create->holdingId = $request->input('holding_id');
        $create->name = $request->input('company_name');
        $create->save();

        activity_log($create->id,'Company','Company',$create->holdingId.','.$create->name,0);
        Session::flash('flash_message', 'New Company succesfully added!');
        return redirect('company');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $holding = Holding::pluck('name','id');
        $company = Company::find($id);
        return view('master.updatecompany',compact('holding','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Company::find($id);
        $old_holding_id = $update->getOriginal('holdingId');
        $old_company_name = $update->getOriginal('name');

        $update->holdingId = $request->input('holding_id');
        $update->name = $request->input('company_name');
        $update->save();

        if($old_holding_id != $update->holdingId) activity_log($update->id,'Company','Holding',$old_holding_id.'=>'.$update->holdingId,1);
        if($old_company_name != $update->name) activity_log($update->id,'Company','Company',$old_company_name.'=>'.$update->name,1);

        Session::flash('flash_message', 'Company succesfully updated!');
        return redirect('company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
