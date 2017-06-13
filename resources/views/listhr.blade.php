@extends('layouts.app')
@section('sections', 'Request')
@if($title == 'join') @section('title', 'Onboard')
@else @section('title','Exit') @endif
@section('content')
<div class="container-fluid">
    <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
    <thead>
        <th class="detail-col">Ticket ID#</th>
        <th class="detail-col">Company</th>
        <th class="detail-col">Name</th>
        <th class="detail-col">Division</th>
        <th class="detail-col">Join date</th>
        <th class="detail-col">{!! $exit_column !!}</th>
        <th class="detail-col">IT Adm</th>
        <th class="detail-col">IT Infra</th>
        <th class="detail-col">IT Apps</th>
        <th class="detail-col">{!! $hr_column !!}</th>
    </thead>
    <tbody>
    	@foreach($list as $value)
        <tr>
          <td width="100"><a href="{{ url($url.'/'.$value->id) }}">{!! $value->ticket !!}</a></td>
          <td width="100">{!! $value['onboard']['company']->name !!}</td>
          <td width="100">{!! $value['onboard']->name !!}</td>
          <td width="100">{!! $value['onboard']['division']->name !!}</td>
          <td width="100">{!! $value['onboard']->joindate !!}</td>
          <td width="20">{!! Carbon\Carbon::parse($value['onboard']->created_at)->format('Y-m-d') !!}</td>
          @if ($value->delivery_date || $value['onboard']->exit_date)<td width="20" class="btn-success" align="right">@else <td width="20" class="btn-warning" align="right"> @endif{!! dateWorkflow($value->id,1,$value['onboard']['company']->holdingId,$value['onboard']->company_id,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
          @if ($value->delivery_date || $value['onboard']->exit_date)<td width="20" class="btn-success" align="right">@else <td width="20" class="btn-warning" align="right"> @endif{!! dateWorkflow($value->id,2,$value['onboard']['company']->holdingId,$value['onboard']->company_id,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
          @if ($value->delivery_date || $value['onboard']->exit_date)<td width="20" class="btn-success" align="right">@else <td width="20" class="btn-warning" align="right"> @endif{!! dateWorkflow($value->id,3,$value['onboard']['company']->holdingId,$value['onboard']->company_id,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
           @if ($value->delivery_date)
           <td width="20" class="btn-success" align="right"> Completed @elseif ($value['onboard']->exit_date) 
           <td width="20" class="btn-success" align="right"> Exit @else
           <td width="20" class="btn-warning" align="right">@if ($value->type_request=='join'){!! Carbon\Carbon::parse($value['onboard']->joindate)->diffInDays($now) !!} Days @endif @endif </td>
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
		bAutoWidth: false,
		"order":[[9,"asc"]]
		});
    });
</script>
@stop
