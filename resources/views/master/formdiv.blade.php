@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
    <thead>
        <th class="detail-col">Name</th>
        <th class="detail-col">Division</th>
        <th class="detail-col">Grade</th>
        <th class="detail-col">Join date</th>
        <th class="detail-col">IT Adm</th>
        <th class="detail-col">IT Infra</th>
        <th class="detail-col">IT Apps</th>
        <th class="detail-col">Delivered</th>
    </thead>
    <tbody>
    	@foreach($list as $value)
        <tr>
          <td width="65">{!! $value->onboardName !!}</td>
          <td width="20">{!! $value->divisionName !!}</td>
		  <td width="100">{!! $value->gradeName !!}<br />
		{!! $value->gradeNotebook !!}<br />{!! $value->gradeSoftware !!}<br />{!! $value->gradeApps !!}</td>
          <td width="20">{!! $value->onboardJoindate !!}</td>
		  <td width="82">{!! $value->onboardStatus !!}</td>
		  <td width="82">{!! $value->onboardStatus !!}</td>
		  <td width="82">{!! $value->onboardStatus !!}</td>
		  <td width="82">{!! $value->onboardStatus !!}</td>
      </tr>
        @endforeach
      </tbody>
	</table>
</div>

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
