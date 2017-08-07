@extends('layouts.app')
@section('sections', 'Request')
@section('title', 'Workflow Process')
@section('content')
<div class="container">
    @if ($req->type_request == 'join') {!! Form::open(array('url'=>$url,'class'=>'form-horizontal','id'=>'infra')) !!}
	@else {!! Form::open(array('url'=>$url.'/exit','class'=>'form-horizontal')) !!}  @endif
    {!! Form::hidden('holding_id',$detail['company']->holdingId) !!}{!! Form::hidden('company_id',$detail->company_id) !!}
    {!! Form::hidden('division_id',$detail->division_id) !!}{!! Form::hidden('position_id',$detail->position_id) !!}
    {!! Form::hidden('type_request',$req->type_request,['id'=>'type_request']) !!}
    <div class="col-sm-10 col-sm-offset-1">
	<div class="widget-box transparent">
		<div class="widget-header widget-header-large">
			<h3 class="widget-title grey lighter">
				<i class="ace-icon fa fa-leaf green"></i>
				@if ($req->type_request == 'join') Workflow {!! $role['roles']->display_name !!}
                @else Workflow Exit Process : {!! $role['roles']->display_name !!} @endif
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
                                <i class="ace-icon fa fa-caret-right blue"></i>Name : <b class="red">{!! Form::hidden('id',$req->id) !!}
                                {!! Form::hidden('onboard_id',$detail->id) !!}{!! $detail->name !!}
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
                            	@if ($req->type_request == 'join')
                                <i class="ace-icon fa fa-caret-right blue"></i>Join Date : <b class="red">{!! Carbon\Carbon::parse($detail->joindate)->format('d F Y') !!}</b>
                            	@else
                                <i class="ace-icon fa fa-caret-right blue"></i>Exit Date : <b class="red">{!! Carbon\Carbon::parse($detail->exit_date)->format('d F Y') !!}</b>
                                @endif
                            </li>
                            <li>
                                <i class="ace-icon fa fa-caret-right blue"></i>Workplace : <b class="red">@if($detail->workplace_id){!! $detail['workplace']->name !!} @endif</b>
                            </li>
                            @if ($req->type_request == 'exit' || $detail->email) 
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
           @foreach($result->chunk(3) as $resulted)
           <div class="row">
                @foreach($resulted as $value)
                <!-- START IT ADMINISTRATOR -->
                <div class="col-xs-12 col-sm-4">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">{!! Form::hidden('it_category',$value['id'], ($value['role_id']!=$role['role_id']) ? ['disabled'=>''] : '') !!}{!! $value['name'] !!}</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">  
                                @foreach($suggested[$value['id']] as $item=>$itemval)
                                <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('is_checked['.$item.']',$itemval['item_id'],in_array($itemval['item_id'],$list) ? 'checked' : '' , ($value['role_id']!=$role['role_id']) ? ['disabled'=>'','class'=>'ace'] : ['class'=>'ace']) !!}                          
                                    <span class="lbl">	 {!! $itemval['item']->name !!} @if($itemval['item']->brand) - {!! $itemval['item']->brand !!} @endif</span>
                                </label>
                                </div>
                                @endforeach
                            </div>											
                        </div>                    
                    </div>
                </div>
                <!-- END IT ADMININSTRATOR -->
                @endforeach
           		<div class="space-10"></div>
            </div>
            @endforeach
            <!-- END ONBOARD DETAIL -->
			<div class="space-24"></div>
            @if ($req->type_request == 'join' && $role['role_id']=='3') 
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
                {!! Form::textarea('comment', $workflow->comment, ['class' => 'form-control']) !!}
                </div>
            </div>            
	    </div>
    </div>
    <div class="hr hr-16 hr-dotted"></div>
        <div class="clearfix ">
           <div class="col-md-offset-3 col-md-9">
            <a class="btn btn-primary radius-4 " href="{{ url('/ListOnBoard') }}">Back</a>
            @if($role['role_id']!='1' && !$workflow->completed_at)
            {!! Form::submit('Submit', ['id'=>'submit','name'=>'submit','class' => 'btn btn-primary radius-4']) !!}
            {!! Form::submit('Completed', ['name'=>'completed','class' => 'btn btn-primary radius-4']) !!}
            @endif
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