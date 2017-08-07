@extends('layouts.app')
@section('sections', 'Admin')
@section('title', 'Role User')
@section('content')
<a href="{{ url('manage-role/create') }}" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i>Create</a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">Results for "Latest Registered Roles"</div>
<div>
    <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
    <thead>
        <th class="detail-col">No</th>
        <th class="detail-col">Role Name</th>
        <th class="detail-col">User Name</th>
        <th class="detail-col">Action</th>
    </thead>
    <tbody>
    	@foreach($result as $key=>$value)
        <tr>
       		<td>{!! $key+1 !!}</th>
            <th>{!! $value['roles']->display_name !!}  </th>
            <th>{!! $value['users']->name !!}	( {!! $value['users']->email !!} )</th>
            <td>{!! Form::open(['method' => 'DELETE', 'route'=>['manage-role.destroy',$value->user_id ,'role'=>$value->role_id]]) !!} 
                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure?')"> <span class="glyphicon glyphicon-trash"></span> </button>
                {{ Form::close() }}</td>
        </tr>
        @endforeach	
    </tbody>
	</table>

<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('custom-page-script')
<script type="text/javascript" src="{{ asset('/bootstrap/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bootstrap/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script>
    jQuery(function($) {
        var myTable = $('#dt-listhr').DataTable({bAutoWidth: false});
    });
</script>
@stop
