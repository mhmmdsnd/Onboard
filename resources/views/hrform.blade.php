@extends('layouts.app')
@section('sections', 'Employee')
@section('title', 'New Employee')
@section('content')
<div class="page-header">
  <h1>@yield('title')</h1>
</div>
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {!! Form::open(array('class'=>'form-horizontal','url'=>'onboard','id'=>'hrform')) !!}
    <div class="form-group">
        {!! Form::label('name', 'Employee Name *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
         <div class="clearfix">
			{!! Form::text('onboardName', null, ['id'=>'onboardName','class' => 'col-xs-10 col-sm-4']) !!}
        </div>
        </div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Group *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
        <div class="clearfix">
			{!! Form::select('holding_id', $holding, null, ['id'=>'holding_id', 'placeholder' => 'Please Select...']) !!}
        </div>
    	</div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Company *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
        <select id='onboardCompany' name="onboardCompany">
        	<option>Please Select...</option>
        </select>
    	</div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Division *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
        <div class="clearfix">
			{!! Form::text('division_name',null, ['id'=>'division_name','class' => 'col-xs-10 col-sm-4']) !!}
        </div>
    	</div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Department *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
        <div class="clearfix">
			{!! Form::text('subdivision_name',null, ['id'=>'subdivision_name','class' => 'col-xs-10 col-sm-4']) !!}
        </div>
    	</div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Level *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
        <div class="clearfix">
			{!! Form::select('position_id',$position, null, ['id'=>'position_id','placeholder' => 'Please Select...']) !!}
           </div>
    	</div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Title ', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
		{!! Form::text('title',null, ['class' => 'col-xs-10 col-sm-4']) !!}
    	</div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Grade ', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
		{!! Form::select('grade_id',$grade, null, ['id'=>'grade_id','placeholder' => 'Please Select...']) !!}
    	</div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Request By *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
        <div class="clearfix">
			{!! Form::text('request_name',null, ['id'=>'request_name','class' => 'col-xs-10 col-sm-4']) !!}	
        </div>
    	</div>
    </div>
    <div class="form-group">
     	{!! Form::label('name', 'Requester Email *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
        <div class="clearfix">
			{!! Form::text('request_email',null, ['id'=>'request_email','class' => 'col-xs-10 col-sm-4']) !!}
        </div>
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
		{!! Form::select('onboardWP',$workplace, null, ['id'=>'onboardWP','placeholder' => 'Please Select...'], ['class' => 'input-xlg bigger-100']) !!}
    	</div>
    </div>
    <div class="form-group">
	    <div class="col-md-offset-3 col-md-9">
  		{!! Form::submit('Submit', ['class' => 'btn btn-primary btn-xlg bigger-100 radius-4']) !!}
    	</div>
    </div>
    {!! Form::close() !!}

</div>
@stop
@section('custom-page-script')
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap-datepicker3.min.css') }}" />
<link href="{{ asset('/bootstrap/css/pace.min.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ asset('/bootstrap/js/pace.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/jquery.validate.min.js') }}"></script>
<script>
    jQuery(function($) {	
		$('#holding_id').change(function(){
			$.get("{{ url('/ListOnBoard/company')}}", 
			{ group: $('#holding_id').val() }, 
			function(data) {
					var model = $('#onboardCompany');
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
		
		$('#hrform').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				onboardName: {
					required: true
				},holding_id : {
					required: true
				},onboardCompany : {
					required: true
				},division_name: {
					required: true
				},request_name : {
					required: true
				},request_email : {
					required: true
				},subdivision_name : {
					required: true
				},onboardJoindate : {
					required: true
				},position_id : {
					required: true
				},grade_id : {
					required: true
				},onboardWP : {
					required: true
				}
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
				$('form input[type=submit]').attr('disabled', 'disabled');
				form.submit();
				return false;
			}
		});	
    });
</script>
@stop
