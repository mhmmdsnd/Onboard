@extends('layouts.app')
@section('sections', 'Employee')
@section('title', 'List')
@section('content')
<div class="container-fluid">
    <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
    <thead>
        <th class="detail-col">Name</th>
        <th class="detail-col">Company</th>
        <th class="detail-col">Division</th>
        <th class="detail-col">Join date</th>
        <th class="detail-col">Exit Proceed</th>
    </thead>
    <tbody>
    	@foreach($list as $value)
        <tr>
          <td width="100"><a href="{{ url('employee/'.$value->id) }}">{!! $value->name !!}</a></td>
          <td width="100">{!! $value['company']->name !!}</td>
          <td width="100">{!! $value['division']->name !!}</td>
          <td width="100">{!! $value->joindate !!}</td>
          @if ($value->exit_date)<td width="20" class="btn-success" align="right"> Already Resign
          @elseif(statusWorkflow($value->id)) <td width="20" class="btn-warning" align="right"> {!! statusWorkflow($value->id) !!}
          @else <td width="20" align="right">
          <a href="{{ url('hrexit/'.$value->id) }}">
           		<i class="ace-icon fa fa-sign-out bigger-120"></i> Exit
          </a>@endif</td>
      </tr>
        @endforeach
      </tbody>
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
		bAutoWidth: false});
    });
</script>
@stop
