@extends('layouts.app')
@section('sections', 'Employee')
@section('title', 'Clearance / Exit')
@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {!! Form::open(array('class'=>'form-horizontal','url'=>'hrexit', 'id'=>'exitform')) !!}
    <div class="col-sm-10 col-sm-offset-1">
	<div class="widget-box transparent">
		<div class="widget-header widget-header-large">
			<h3 class="widget-title grey lighter">
				<i class="ace-icon fa fa-leaf green"></i>
				@yield('title')
			</h3>
            <div class="widget-toolbar no-border invoice-info">
                <span class="invoice-info-label">Request By :</span>
                <span class="red">{!! $detail->created_by !!}</span>

                <br />
                <span class="invoice-info-label">Request Date :</span>
                <span class="blue">{!! $detail->created_at->diffForHumans() !!}</span>
            </div>
		</div>
		<div class="widget-body">
        <div class="widget-main padding-24">
            <div class="row">
                <div class="col-sm-9">
                    <div>
                        <ul class="list-unstyled spaced">
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>NIK : <b class="red">{!! $detail->nik !!}
                                </b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Name : <b class="red">{!! Form::hidden('onboard_id',$detail->id) !!}{!! $detail->name !!}
                                </b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Company : <b class="red">{!! $detail['company']->name !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Division : <b class="red">@if($detail->division_id){!! $detail['division']->name !!} @else {!! $detail->division_name !!} @endif</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Department : <b class="red">@if($detail->subdivision_id){!! $detail['subdivision']->name !!} @else {!! $detail->subdivision_name !!} @endif</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Level : <b class="red">@if($detail->position_id){!! $detail['position']->name !!} @endif</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Grade : <b class="red">@if($detail->grade_id) {!! $detail->grade_id !!} @endif</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Title : <b class="red">{!! $detail->title !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Request By : <b class="red">{!! $detail->request_name !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Requester Email : <b class="red">{!! $detail->request_email !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Join Date : <b class="red">{!! Carbon\Carbon::parse($detail->joindate)->format('d F Y') !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Workplace : <b class="red">@if($detail->workplace_id){!! $detail['workplace']->name !!} @endif</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Email : <b class="red">{!! $detail->email !!}</b>
                            </li>
                         </ul>
                    </div>
                </div><!-- /.col -->
         	</div><!-- /.row -->
            <div class="space"></div>
            <h3 class="header smaller lighter blue">
                <i class="ace-icon fa fa-leaf green"></i> Detail
            </h3>
            <!-- START ONBOARD DETAIL -->
            @foreach($result->chunk(3) as $resulted)
            <div class="row">
            <!-- START IT ADMINISTRATOR -->
            @foreach($resulted as $key=>$value)
            <div class="col-xs-12 col-sm-4">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">{!! $value !!}</h4>
                    </div>
                    <div class="widget-body">
						<div class="widget-main"> 
                      		@foreach($suggested[$key] as $item=>$itemval)
                        <div class="checkbox">
                        <label>
                            {!! Form::checkbox('is_checked['.$item.']',$itemval['item_id'],'checked', ['class'=>'ace','disabled'=>'']) !!}        
                            <span class="lbl">
                            {!! $itemval['item']->name !!}</span>
                        </label>
                        </div>
                      @endforeach
                      </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- END IT ADMININSTRATOR -->
            </div>
            @endforeach
            <div class="space-24"></div>
            <!-- END ONBOARD DETAIL -->
            <div class="form-group">
            {!! Form::label('resign', 'Exit Date *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                        </span>
                    {!! Form::date('exit_date', null, ['id'=>'exit_date','class' => 'col-xs-4 col-sm-2 date-picker', 'data-date-format'=>'yyyy-mm-dd', 'readonly'=>'']) !!}
                    </div>
                </div>
             </div>
            <div class="hr hr-16 hr-dotted"></div>
              <div class="clearfix ">
                <div class="col-md-offset-3 col-md-9">
                <a class="btn btn-primary radius-4 " href="{{ url('/employee') }}">Back</a>
                {!! Form::submit('Clearance', ['id'=>'submit','name'=>'submit','class' => 'btn btn-primary radius-4']) !!}
            
                </div>
              </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop
@section('custom-page-script')
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap-datepicker3.min.css') }}" />
<script src="{{ asset('/bootstrap/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {
	 $('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
	 $('#exitform').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				exit_date: {
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
	 $("#submit").click(function(event) {
        if( !confirm('Submit this employee for clearance ?') ){
            event.preventDefault();
        } 
    });
});
</script>
@stop