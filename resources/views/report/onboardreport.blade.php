@extends('layouts.app')
@section('sections', 'Onboard Report')
@section('title', 'Onboard Report - Onboard')
@section('content')
<div class="container">
	{!! Form::open(array('class'=>'form-horizontal','id'=>'slareport')) !!}
    <div class="form-group">
        {!! Form::label('name', 'Request Date ', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
		<div class="col-sm-5">
            <div class="input-daterange input-group">
                {!! Form::text('start_date', null, ['id'=>'start_date','class' => 'input-sm form-control', 'readonly'=>'']) !!}
                <span class="input-group-addon">
                   <i class="fa fa-exchange"></i>
                </span>
                {!! Form::text('end_date', null, ['id'=>'end_date','class' => 'input-sm form-control', 'readonly'=>'']) !!}
            </div>
    	</div>
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Department *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
            <div class="clearfix">
                {!! Form::select('division_id', $division, null, ['id'=>'division_id', 'placeholder' => 'Please Select...']) !!}
            </div>
        </div>
    </div>
    <div class="space-20"></div>
    <div class="clearfix">
        <div class="col-md-offset-3 col-md-9">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary radius-4']) !!}
        </div>
    </div>
    @if($division_id)
    <!-- START RESULT -->
    <div class="widget-body">
    	<div class="widget-main padding-24">
        	<div class="row">
                <div class="col-sm-9">
                	<div>
                        <ul class="list-unstyled spaced">
                        	<li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Total  : <b class="red">{!! $total !!} Request</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>In Progress / Pending  : <b class="red">{!! $pending !!} Request</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Completed  : <b class="red">{!! $completed !!} Request</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Completed AVG  : <b class="red">{!! $avg_terms->total !!} Days</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Completed MIN  : <b class="red">{!! $min_terms->total !!} Days</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Completed MAX  : <b class="red">{!! $max_terms->total !!} Days</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END RESULT -->
     <div class="space"></div>
      <h3 class="header smaller lighter blue">
        <i class="ace-icon fa fa-leaf green"></i> Detail
    </h3>
    <!-- START LIST ITEM ONBOARD -->
    <table id="dt-onboard" class="table table-striped table-bordered table-hover first-table">
    <thead>  
        <tr>
          <th rowspan="2">Item </th>
          <th rowspan="2">Total</th>
          <th rowspan="2">In Progress / Pending</th>
          <th rowspan="2">Completed</th>
          <th colspan="3">Completion Terms</th>
      </tr>
      <tr>
          <th>AVG</th>
          <th>Min</th>
          <th>Max</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($list_item as $list=>$value)
        <tr>
        	<td width="100">{!! $value['item']->name !!}</td>
            <td width="100">0</td>
            <td width="100">0</td>
            <td width="100">{!! $complete[$list] !!}</td>
            <td width="100">{!! $average[$list] !!}</td>
            <td width="100">{!! $minimum[$list] !!}</td>
            <td width="100">{!! $maximum[$list] !!}</td>
        </tr>
        @endforeach
     </tbody> 
	</table>
    <!-- END LIST ITEM ONBOARD -->
    @endif
</div>
@stop
@section('custom-page-script')
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap-datepicker3.min.css') }}" />
<script src="{{ asset('/bootstrap/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/jquery.validate.min.js') }}"></script>
<script>
    jQuery(function($) {
		$('#slareport').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				start_date: { required: true },
				end_date: { required: true }
			},
			messages: {
				start_date: { required: "Please insert start date."},
				end_date: { required: "Please insert end date."}
			},
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
				$(e).remove();
			},
			errorPlacement: function (error, element) {
				error.insertAfter(element.parent());
			},
			submitHandler: function (form) {
				form.submit();
			}
		});	
		$('.input-daterange').datepicker({autoclose:true});
    });
</script>
@stop
