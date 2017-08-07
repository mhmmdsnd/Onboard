@extends('layouts.app')
@section('sections', 'Request')
@if($title == 'join') @section('title', 'Onboard')
@else @section('title','Exit') @endif
@section('content')
<div class="container-fluid">
<a href="{{ url('ListOnBoard/excel') }}" class="btn btn-app btn-primary btn-xs">
    <i class="ace-icon fa fa-download bigger-160"></i>Excel</a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">Results for "Latest Registered Onboarding"</div>
<div>
    <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
    <thead>
        <th class="detail-col">Ticket ID#</th>
        <th class="detail-col">Company</th>
        <th class="detail-col">NIK</th>
        <th class="detail-col">Name</th>
        <th class="detail-col">Title</th>
        <th class="detail-col">{!! $join_column !!}</th>
        <th class="detail-col">{!! $exit_column !!}</th>
        <th class="detail-col">IT Adm</th>
        <th class="detail-col">IT Infra</th>
        <!--<th class="detail-col">IT Apps</th>-->
        <th class="detail-col">HR SS</th>
        <th class="detail-col">GA</th>
        <th class="detail-col">{!! $hr_column !!}</th>
        @role('hr')<th class="detail-col">Action</th>@endrole
    </thead>
    <tbody>
    	@foreach($list as $value)
        @php 
        	if ($value['onboard']->company_id!='') $company = $value['onboard']->company_id;
        	else $company = '0';
        	if ($value['onboard']->company_id!='') $holding = $value['onboard']['company']->holdingId;
        	else $holding = '0';
        @endphp
        <tr>
          <td width="50"><a href="{{ url($url.'/'.$value->id) }}">{!! $value->ticket !!}</a></td>
          <td width="100">@if($value['onboard']->company_id !='') {!! $value['onboard']['company']->name !!} @endif</td>
          <td width="100">{!! $value['onboard']->nik !!}</td>
          <td width="100">{!! $value['onboard']->name !!}</td>
          <td width="100">{!! $value['onboard']->title !!}</td>
          <td width="60">@if ($value->type_request=='join') {!! Carbon\Carbon::parse($value['onboard']->joindate)->format('d M Y') !!} @else {!! Carbon\Carbon::parse($value['onboard']->exit_date)->format('d M Y') !!} @endif</td>
          <td width="60">{!! Carbon\Carbon::parse($value['onboard']->created_at)->format('d M Y') !!}</td>
          <td width="30" class="{!! statusError($value->id,1) !!}" align="right">{!! dateWorkflow($value->id,1,$holding,$company,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
          <td width="30" class="{!! statusError($value->id,2) !!}" align="right">{!! dateWorkflow($value->id,2,$holding,$company,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
          <?php /*?><td width="20" class="{!! statusError($value->id,3) !!}" align="right">{!! dateWorkflow($value->id,3,$holding,$company,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td><?php */?>
          <td width="30" class="{!! statusError($value->id,4) !!}" align="right">{!! dateWorkflow($value->id,4,$holding,$company,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
          <td width="30" class="{!! statusError($value->id,5) !!}" align="right">{!! dateWorkflow($value->id,5,$holding,$company,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
           @if ($value->delivery_date)
           <td width="20" class="btn-success" align="right"> {!! Carbon\Carbon::parse($value->delivery_date)->format('d M Y') !!} @elseif ($value['onboard']->clearance_date) 
           <td width="20" class="btn-success" align="right"> {!! Carbon\Carbon::parse($value['onboard']->clearance_date)->format('d M Y') !!} @else
           <td width="20" class="{!! statusError($value->id) !!}" align="right">
           @if ($value->type_request=='join')
           		{!! Carbon\Carbon::parse($now)->diffInDays(Carbon\Carbon::parse($value['onboard']->joindate),false) !!} 
           @else 
           		{!! Carbon\Carbon::parse($now)->diffInDays(Carbon\Carbon::parse($value['onboard']->exit_date),false) !!}  
           @endif 
           Days
           @endif </td>
           @role('hr')
           <td width="20">
           	<div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle">
                    Action
                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                </button>
                <ul class="dropdown-menu">
                @if ($value->type_request=='join')
                    <li>
                        <a href="{{ url('hr-detail/'.$value->id) }}">Prepared Item</a>
                    </li>
                    <li>
                        <a href="{{ url('review/'.$value->id) }}">Review</a>
                    </li>
                 @else
                 	<li>
                        <a href="{{ url('hr-detail/'.$value->id) }}">HR Exit Item</a>
                    </li>
                 @endif
                </ul>
            </div><!-- /.btn-group -->
           </td>@endrole
      </tr>
        @endforeach
      </tbody>
	</table>
</div>
    </div>
@stop
@section('custom-page-script')
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/bootstrap/css/pace.min.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ asset('/bootstrap/js/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bootstrap/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bootstrap/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script>
    jQuery(function($) {
		$(document).ajaxStart(function() { Pace.restart(); });
        var myTable = $('#dt-listhr').DataTable({
		bAutoWidth: false,
		"order":[[6,"asc"]]
		});
    });
</script>
@stop
