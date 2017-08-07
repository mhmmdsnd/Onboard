@extends('layouts.app')
@section('sections', 'Master')
@section('title', 'Manage Group')
@section('content')
<a href="{{ url('holding/create') }}" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i>Create</a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">Results for "Latest Registered Group"</div>
<div>
    <table id="dt-holding" class="table table-striped table-bordered table-hover first-table">
    <thead>
        <th class="detail-col">No</th>
        <th class="detail-col">Group Name</th>
        <th class="detail-col">Action</th>
    </thead>
    <tbody>
    	@foreach($result as $key=>$value)
        <tr>
       		<td>{!! $key+1 !!}</th>
            <th>{!! $value->name !!}  </th>
            <td><a href="{{ url('holding/'.$value->id.'/edit')}}">Edit</a></td>
        </tr>
        @endforeach	
      </tbody>
	</table>

@stop
@section('custom-page-script')
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ asset('/bootstrap/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bootstrap/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script>
    jQuery(function($) {
        var myTable = $('#dt-holding').DataTable({bAutoWidth: false});
    });
</script>
@stop
