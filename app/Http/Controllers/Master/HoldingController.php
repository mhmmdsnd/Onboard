<?php

namespace App\Http\Controllers\Master;

use App\Holding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HoldingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Holding::get();

        return view('master.listholding', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.addholding');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = New Holding();
        $create->name = $request->input('group_name');
        $create->created_by = Auth::user()->id;
        $create->save();

        activity_log($create->id, 'Holding', 'Holding',"Holding Name : ".$create->name,0);
        Session::flash('flash_message', 'New Group succesfully added!');
        return redirect('holding');
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
        $holding = Holding::find($id);
        return view('master.updateholding', compact('holding'));
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
        $update = Holding::find($id);
        $old_group_name = $update->getOriginal('name');

        $update->name = $request->input('group_name');
        $update->updated_by = Auth::user()->id;
        $update->save();

        activity_log($update->id, 'Holding', 'Holding',"Holding Name : ".$old_group_name." -> ".$update->name,1);
        Session::flash('flash_message', 'Group succesfully updated!');
        return redirect('holding');
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
