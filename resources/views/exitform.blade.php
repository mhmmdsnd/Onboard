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
    {!! Form::open(['class'=>'form-horizontal','action'=>'HRExitController@store']) !!}
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
                                <i class="ace-icon fa fa-caret-right blue"></i>Name : <b class="red">{!! Form::hidden('onboard_id',$detail->id) !!}{!! $detail->name !!}
                                </b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Company : <b class="red">{!! $detail['company']->name !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Division : <b class="red">@if($detail->division_id){!! $detail['division']->name !!}@endif</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Department : <b class="red">@if($detail->subdivision_id){!! $detail['subdivision']->name !!}@endif</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Level : <b class="red">{!! $detail['position']->name !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Title : <b class="red">{!! $detail->title !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Join Date : <b class="red">{!! $detail->joindate !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Workplace : <b class="red">{!! $detail['workplace']->name !!}</b>
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
            <div class="row">
            <!-- START IT ADMINISTRATOR -->
            <div class="col-xs-12 col-sm-4">
            	<div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">IT Administrator</h4>
                    </div>
					<div class="widget-body">
						<div class="widget-main">  
                            @foreach($suggested[1] as $key=>$value)
                            <div class="checkbox">
                            <label>
                                {!! Form::checkbox('admin['.$key.']',$value['item_id'],'checked',['class'=>'ace','disabled'=>true]) !!}
                                <span class="lbl"> {!! $value['item']->name !!}</span>
                            </label>
                            </div>
                            @endforeach
                        </div>											
					</div>                    
                </div>
            </div>
            <!-- END IT ADMININSTRATOR -->
            <!-- START IT INFRASTRUCTURE -->
            <div class="col-xs-12 col-sm-4">
            	<div class="widget-box">
                	<div class="widget-header">
                    	<h4 class="widget-title">IT Infrastructure</h4>
                	</div>
					<div class="widget-body">
						<div class="widget-main">  
                            @foreach($suggested[2] as $key=>$value)
                            <div class="checkbox">
                            <label>
                                {!! Form::checkbox('infra['.$key.']',$value['item_id'],'checked',['class'=>'ace','disabled'=>true]) !!}                               
                                <span class="lbl"> {!! $value['item']->name !!}</span>
                            </label>
                            </div>
                            @endforeach
                        </div>											
					</div>                    
                </div>
            </div>
            <!-- END IT INFRASTRUCTURE -->
            <!-- START IT APPLICATION -->
            <div class="col-xs-12 col-sm-4">
            	<div class="widget-box">
	                <div class="widget-header">
                    	<h4 class="widget-title">IT Application</h4>
                	</div>
					<div class="widget-body">
						<div class="widget-main">  
                            @foreach($suggested[3] as $key=>$value)
                            <div class="checkbox">
                            <label>
                                {!! Form::checkbox('apps['.$key.']',$value['item_id'],'checked',['class'=>'ace','disabled'=>true]) !!}                               
                                <span class="lbl"> {!! $value['item']->name !!}</span>
                            </label>
                            </div>
                            @endforeach
                        </div>											
					</div>                    
                </div>
            </div>
            <!-- END IT APPLICATION -->
            </div>
            <div class="space-10"></div>
            <!-- END ONBOARD DETAIL -->
            <!-- START ONBOARD DETAIL -->
            <div class="row">
            	<!-- START HR Division -->
                <div class="col-xs-12 col-sm-4">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">HR Self-service</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">  
                                @foreach($suggested[4] as $key=>$value)
                                <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('hrss',$value['item_id'],'checked',['class'=>'ace','disabled'=>true]) !!}                               
                                    <span class="lbl">	{!! $value['item']->name !!}</span>
                                </label>
                                </div>
                                @endforeach
                            </div>											
                        </div>                    
                    </div>
            	</div>
            <!-- END HR Division -->
            	<!-- START GA Division -->
                <div class="col-xs-12 col-sm-4">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">GA Division</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">  
                                @foreach($suggested[5] as $key=>$value)
                                <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('ga',$value['item_id'],'checked',['class'=>'ace','disabled'=>true]) !!}                               
                                    <span class="lbl">	{!! $value['item']->name !!}</span>
                                </label>
                                </div>
                                @endforeach
                            </div>											
                        </div>                    
                    </div>
            	</div>
                <!-- END GA Division -->
            </div>
            <div class="space-24"></div>
            <!-- END ONBOARD DETAIL -->
            </div>
            </div>
            <div class="hr hr-16 hr-dotted"></div>
              <div class="clearfix ">
                <div class="col-md-offset-3 col-md-9">
                <a class="btn btn-primary radius-4 " href="{{ url('/Employee') }}">Back</a>
                {!! Form::submit('Clearance', ['id'=>'submit','name'=>'submit','class' => 'btn btn-primary radius-4']) !!}
            
                </div>
              </div>
        </div>
    </div>
    {!! Form::close() !!}
	
</div>
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('custom-page-script')
<script type="text/javascript">
jQuery(function($) {
	 $("#submit").click(function(event) {
        if( !confirm('Submit this employee for clearance ?') ){
            event.preventDefault();
        } 
    });
	$("form").on("submit", function () {
    	$(this).find(":submit").prop("disabled", true);
	});
});
</script>
@stop