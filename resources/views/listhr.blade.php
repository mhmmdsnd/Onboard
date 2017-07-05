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
        <th class="detail-col">Title</th>
        <th class="detail-col">Join date</th>
        <th class="detail-col">{!! $exit_column !!}</th>
        <th class="detail-col">IT Adm</th>
        <th class="detail-col">IT Infra</th>
        <th class="detail-col">IT Apps</th>
        <th class="detail-col">HR SS</th>
        <th class="detail-col">GA</th>
        <th class="detail-col">{!! $hr_column !!}</th>
        @role('hr')<th class="detail-col">Action</th>@endrole
    </thead>
    <tbody>
    	@foreach($list as $value)
        @php 
        	if ($value['onboard']->company_id!='') $holding = $value['onboard']['company']->holdingId;
        	else $holding = '0';
        @endphp
        <tr>
          <td width="100"><a href="{{ url($url.'/'.$value->id) }}">{!! $value->ticket !!}</a></td>
          <td width="100">@if($value['onboard']->company_id !='') {!! $value['onboard']['company']->name !!} @endif</td>
          <td width="100">{!! $value['onboard']->name !!}</td>
          <td width="100">{!! $value['onboard']->title !!}</td>
          <td width="100">{!! $value['onboard']->joindate !!}</td>
          <td width="20">{!! Carbon\Carbon::parse($value['onboard']->created_at)->format('Y-m-d') !!}</td>
          @if ($value->delivery_date || $value['onboard']->exit_date)<td width="20" class="btn-success" align="right">@else <td width="20" class="btn-warning" align="right"> @endif{!! dateWorkflow($value->id,1,$holding,$value['onboard']->company_id,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
          @if ($value->delivery_date || $value['onboard']->exit_date)<td width="20" class="btn-success" align="right">@else <td width="20" class="btn-warning" align="right"> @endif{!! dateWorkflow($value->id,2,$holding,$value['onboard']->company_id,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
          @if ($value->delivery_date || $value['onboard']->exit_date)<td width="20" class="btn-success" align="right">@else <td width="20" class="btn-warning" align="right"> @endif{!! dateWorkflow($value->id,3,$holding,$value['onboard']->company_id,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
          @if ($value->delivery_date || $value['onboard']->exit_date)<td width="20" class="btn-success" align="right">@else <td width="20" class="btn-warning" align="right"> @endif{!! dateWorkflow($value->id,4,$holding,$value['onboard']->company_id,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
          @if ($value->delivery_date || $value['onboard']->exit_date)<td width="20" class="btn-success" align="right">@else <td width="20" class="btn-warning" align="right"> @endif{!! dateWorkflow($value->id,5,$holding,$value['onboard']->company_id,$value['onboard']->division_id,$value['onboard']->position_id) !!} </td>
           @if ($value->delivery_date)
           <td width="20" class="btn-success" align="right"> {!! Carbon\Carbon::parse($value->delivery_datet)->format('Y-m-d') !!} @elseif ($value['onboard']->exit_date) 
           <td width="20" class="btn-success" align="right"> Exit @else
           <td width="20" class="btn-warning" align="right">@if ($value->type_request=='join'){!! $now->diffInDays(Carbon\Carbon::parse($value['onboard']->joindate),false) !!} Days @endif @endif </td>
           @role('hr')<td width="20">
           	<div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle">
                    Action
                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ url('hr-detail/'.$value->id) }}">Prepared Item</a>
                    </li>
                    <li>
                        <a href="{{ url('review/'.$value->id) }}">Review</a>
                    </li>
                </ul>
            </div><!-- /.btn-group -->
           </td>@endrole
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
		"order":[[11,"desc"]]
		});
    });
</script>
@stop
