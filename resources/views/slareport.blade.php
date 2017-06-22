@extends('layouts.app')
@section('sections', 'SLA Report')
@section('title', 'SLA Report - Onboard')
@section('content')
<div class="container">
	{!! Form::open(array('class'=>'form-horizontal','id'=>'slareport')) !!}
    <div class="form-group">
        {!! Form::label('name', 'Request Date ', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
		<div class="col-sm-5">
            <div class="input-daterange input-group">
                {!! Form::date('start_date', null, ['id'=>'start_date','class' => 'input-sm form-control', 'readonly'=>'']) !!}
                <span class="input-group-addon">
                   <i class="fa fa-exchange"></i>
                </span>
                {!! Form::date('end_date', null, ['id'=>'end_date','class' => 'input-sm form-control', 'readonly'=>'']) !!}
            </div>
    	</div>
    </div>
    <div class="space-20"></div>
    <div class="clearfix">
	    <div class="col-md-offset-3 col-md-9">
  		{!! Form::submit('Submit', ['class' => 'btn btn-primary radius-4']) !!}
    	</div>
    </div>
    @if ($result)
    <div class="form-group">
        <div class="col-sm-8">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title lighter">
                    <i class="ace-icon fa fa-star orange"></i>
                    SLA Report
                </h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <div class="widget-body">
                  <div class="widget-main no-padding">
                  <table class="table table-bordered table-striped">
                      <thead class="thin-border-bottom">
                          <tr>
                              <th></th>
                              @foreach($result as $key=>$value)
                              <th><i class="ace-icon fa fa-caret-right blue"></i>{!! $value !!}</th>
                              @endforeach
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>Average</td>
                            @foreach($result as $key=>$value)
                             <td align="right">{!! $average[$key][0]->total !!}</td>
                            @endforeach
                        </tr>
                          <tr>
                            <td>Minimal</td>
                            @foreach($result as $key=>$value)
                             <td align="right">{!! $minimum[$key][0]->total !!}</td>
                            @endforeach
                        </tr>
    
                          <tr>
                            <td>Maximal</td>
                            @foreach($result as $key=>$value)
                             <td align="right">{!!$maximum[$key][0]->total !!}</td>
                            @endforeach
                        </tr>
    
                          <tr>
                            <td>In progress request</td>
                             @foreach($result as $key=>$value)
                             <td align="right">{!! $progress[$key] !!}</td>
                            @endforeach
                        </tr>
                          <tr>
                            <td>Total item prepared</td>
                             @foreach($result as $key=>$value)
                             <td align="right">{!! $prepared[$key] !!}</td>
                            @endforeach
                        </tr>
                          <tr>
                            <td>Total item completed</td>
                            @foreach($result as $key=>$value)
                             <td align="right">{!! $completed[$key] !!}</td>
                            @endforeach
                        </tr>
                          <tr>
                            <td>Total request</td>
                             <td align="center" colspan="{!! count($result) !!}">{!! $total !!}</td>
                             </tr>
                      </tbody>
                  </table>
              </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    	</div><!-- /.col -->
        @endif
     </div>
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
