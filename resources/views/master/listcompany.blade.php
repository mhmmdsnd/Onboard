@extends('layouts.app')
@section('sections', 'Master')
@section('title', 'Manage Company')
@section('content')
<a href="{{ url('company/create') }}" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i>Create</a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">Results for "Latest Registered Company"</div>
<div>
    <table id="dt-company" class="table table-striped table-bordered table-hover first-table">
    <thead>
        <th class="detail-col">No</th>
        <th class="detail-col">Group Name</th>
        <th class="detail-col">Company Name</th>
        <th class="detail-col">Action</th>
    </thead>
    <tbody>
    	@foreach($result as $key=>$value)
        <tr>
       		<td>{!! $key+1 !!}</td>
            <td>{!! $value->name !!}  </td>
            <td>{!! $value['holding']->name !!}</td>
            <td><a href="{{ url('company/'.$value->id.'/edit')}}">Edit</a></td>
        </tr>
        @endforeach	
      </tbody>
	</table>
    {!! $result->render() !!}
</div>
@stop
@section('custom-page-script')
@stop
