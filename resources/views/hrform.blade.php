@extends('layouts.app')
@section('sections', 'Employee')
@section('title', 'New Employee')
@section('content')
<div class="page-header">
  <h1>Employee OnBoarding</h1>
</div>
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {!! Form::open(['class'=>'form-horizontal','action' => 'OnboardController@store']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Employee Name *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
		{!! Form::text('onboardName', null, ['class' => 'col-xs-10 col-sm-4']) !!}
        </div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Company *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
		{!! Form::select('onboardCompany', $company, null, ['placeholder' => 'Please Select...']) !!}
    	</div>
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Division *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
		{!! Form::select('onboardDivision',$divisi, null, ['id'=>'onboardDivision','placeholder' => 'Please Select...']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Department *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
        <select id='subdivision_id' name="subdivision_id">
        	<option>Please Select...</option>
        </select>
        </div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Position *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
		{!! Form::select('position_id',$position, null, ['placeholder' => 'Please Select...']) !!}
    	</div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Join Date *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
		<div class="col-sm-9">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar bigger-110"></i>
            </span>
        {!! Form::date('onboardJoindate', null, ['id'=>'onboardJoindate','class' => 'col-xs-4 col-sm-2 date-picker', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'']) !!}
        </div>
    </div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Workplace *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
		{!! Form::select('onboardWP',$workplace, null, ['placeholder' => 'Please Select...'], ['class' => 'input-xlg bigger-100']) !!}
    	</div>
    </div>
    <div class="form-group">
	    <div class="col-md-offset-3 col-md-9">
  		{!! Form::submit('Submit', ['class' => 'btn btn-primary btn-xlg bigger-100 radius-4']) !!}
    	</div>
    </div>
    {!! Form::close() !!}

</div>
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap-datepicker3.min.css') }}" />
@stop
@section('custom-page-script')
<script src="{{ asset('/bootstrap/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    jQuery(function($) {
		$("form").on("submit", function () {
    		$(this).find(":submit").prop("disabled", true);
		});
        $('#onboardDivision').change(function(){
			$.get("{{ url('/ListOnBoard/divisions')}}", 
			{ option: $(this).val() }, 
			function(data) {
					var model = $('#subdivision_id');
					model.empty();
 					$.each(data, function(key, value) {
			            model.append("<option value='"+ key +"'>" + value + "</option>");
			        });
			});
		});
		
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
    });
</script>
@stop
