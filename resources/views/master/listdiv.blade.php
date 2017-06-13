@extends('layouts.app')
@section('content')
<a href="{{ url('Division/Add') }}" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i>Create</a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">Results for "Latest Registered Division"</div>
<div>
    <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
    <thead>
        <th class="detail-col">No</th>
        <th class="detail-col">Name</th>
        <th class="detail-col">Description</th>
        <th class="detail-col">Action</th>
    </thead>
    <tbody>
    	
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
