@extends('layouts.app')
@section('sections', 'Employee')
@section('title', 'List')
@section('content')
<div class="container-fluid">
	<div class="table-header">Results for "Latest Registered Employee"</div>
    <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
    <thead>
        <th class="detail-col">NIK</th>
        <th class="detail-col">Name</th>
        <th class="detail-col">Company</th>
        <th class="detail-col">Title</th>
        <th class="detail-col">Join date</th>
        <th class="detail-col">Employee Status</th>
        <th class="detail-col">Action</th>
    </thead>
	</table>
</div>
@stop
@section('custom-page-script')
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ asset('/bootstrap/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bootstrap/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script>
    jQuery(function($) {
        var myTable = $('#dt-listhr').DataTable({
		processing: true,
        serverSide: true,
		ajax: {
                url: '{{ url("/employee/data-employee") }}'
            },
		columns: [
            {data: 'nik', name: 'nik',searchable: true},
            {data: 'name', name: 'name', searchable: true},
            {data: 'company.name', name: 'company.name',searchable: true},
            {data: 'title', name: 'title',searchable: true},
			{data: 'joindate', name: 'joindate'},
			{data: 'status',name: 'status'},
			{data: 'action',name: 'action'},
        ],
		bAutoWidth: false});
    });
</script>
@stop
