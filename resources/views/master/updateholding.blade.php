@extends('layouts.app')
@section('sections', 'Master')
@section('title', 'Edit Group')
@section('content')
<div class="page-header">
  <h1>@yield('title')</h1>
</div>
<div class="container">
    {!! Form::open(array('method'=>'PUT','url'=>'holding/'.$holding->id,'class'=>'form-horizontal','id'=>'manage-holding')) !!}
    <div class="form-group">
     	{!! Form::label('name', 'Group *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
        <div class="clearfix">
			{!! Form::text('group_name',$holding->name, ['id'=>'group_name','class' => 'col-xs-10 col-sm-4']) !!}	
           </div>
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
<script src="{{ asset('/bootstrap/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {
$('#manage-holding').validate({
		errorElement: 'div',
		errorClass: 'help-block',
		focusInvalid: false,
		ignore: "",
		rules: {
			group_name: {
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
			form.submit();
		}
	});	
});
</script>
@stop