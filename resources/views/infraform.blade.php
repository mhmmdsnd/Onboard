@extends('layouts.app')
@section('sections', 'Request')
@section('title', 'Workflow IT Infrastructure ')
@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
	@if ($req->type_request == 'join') {!! Form::open(array('url'=>'ITInfra','class'=>'form-horizontal','id'=>'infra')) !!}
	@else {!! Form::open(['class'=>'form-horizontal','action' => 'HRExitController@itstore','id'=>'infra']) !!} @endif
    {!! Form::hidden('holding_id',$detail['company']->holdingId) !!}{!! Form::hidden('company_id',$detail->company_id) !!}
    {!! Form::hidden('division_id',$detail->division_id) !!}{!! Form::hidden('position_id',$detail->position_id) !!}
    {!! Form::hidden('type_request',$req->type_request,['id'=>'type_request']) !!}{!! Form::hidden('it_category',2) !!}
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
                                <i class="ace-icon fa fa-caret-right blue"></i>Name : <b class="red">{!! Form::hidden('id',$req->id) !!}
                                {!! Form::hidden('onboard_id',$detail->id) !!}{!! $detail->name !!}
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
                                <i class="ace-icon fa fa-caret-right blue"></i>Join Date : <b class="red">{!! $detail->joindate !!}</b>
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Workplace : <b class="red">{!! $detail['workplace']->name !!}</b>
                            </li>
                            @if ($req->type_request == 'exit') 
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Email : <b class="red">{!! $detail->email !!}</b>
                            </li>
                            @endif
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
                                {!! Form::checkbox('admin',1,in_array($value['item_id'],$list) ? 'checked' : '',['class'=>'ace','disabled'=>true]) !!}                               
                                <span class="lbl">	{!! $value['item']->name !!} @if($value['item']->brand) - {!! $value['item']->brand !!} @endif</span>
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
                                {!! Form::checkbox('is_checked['.$key.']',$value['item_id'],in_array($value['item_id'],$list) ? 'checked' : '',['class'=>'ace']) !!}                               
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
                                {!! Form::checkbox('apps','1',in_array($value['item_id'],$list) ? 'checked' : '',['class'=>'ace','disabled'=>true]) !!}                               
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
                                    {!! Form::checkbox('apps','1',in_array($value['item_id'],$list) ? 'checked' : '',['class'=>'ace','disabled'=>true]) !!}                               
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
                                    {!! Form::checkbox('apps','1',in_array($value['item_id'],$list) ? 'checked' : '',['class'=>'ace','disabled'=>true]) !!}                               
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
            @if ($req->type_request == 'join') 
           <div class="form-group" id="email-block">
            {!! Form::label('email', 'Email *', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
            <div class="col-xs-12 col-sm-9">
            	<div class="clearfix">
                {!! Form::email('email', $detail->email, ['id'=>'email','class' => 'col-xs-8 col-sm-5']) !!}
                </div>
                <div class="help-block" id="email-error"></div>
            </div>
            </div>
            @endif
            <div class="form-group">
                {!! Form::label('name', 'Comments', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                <div class="col-sm-9">
                {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
                </div>
            </div>            
	    </div>
    </div>
    <div class="hr hr-16 hr-dotted"></div>
        <div class="clearfix ">
           <div class="col-md-offset-3 col-md-9">
            <a class="btn btn-primary radius-4 " href="{{ url('/ListOnBoard') }}">Back</a>
            {!! Form::submit('Submit', ['id'=>'submit','name'=>'submit','class' => 'btn btn-primary radius-4']) !!}
            @if($req->type_request == 'join')  {!! Form::submit('Completed', ['name'=>'completed','class' => 'btn btn-primary radius-4']) !!}  @endif
         </div>
       </div>
    </div>
	</div>    
    {!! Form::close() !!}
</div>
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('custom-page-script')
<script src="{{ asset('/bootstrap/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {
	var type = $("#type_request").val();
	if (type == 'join'){
			$('#infra').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				email: {
					required: true,
					email:true
				}
			},
			messages: {
				email: {
					required: "Please provide a valid email.",
					email: "Please provide a valid email."
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
		$('#email').change(function(){
			var email=$(this).val();
			if(email.length > 3)
			{
				$.ajax({
					type:"get",
					dataType:"json",
					url:"{{url('/ListOnBoard/usermail')}}",
					data: {email: email},
					success:function(data){
						if(data==0){
							$("#email-error").html("Username available");
							$("#email-block").removeClass('has-error').addClass('has-info');
							$("#submit").prop('disabled',false);
							}
						else{
							$("#email-error").html("Username already taken");
							$("#email-block").removeClass('has-info').addClass('has-error');
							$("#submit").prop('disabled',true);
						}
					}
				});
			}
		});
	}
});
</script>
@stop