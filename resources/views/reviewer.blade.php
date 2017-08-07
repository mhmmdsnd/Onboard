@extends('layouts.app')
@section('sections', 'Request')
@section('title', 'Workflow Reviewer ')
@section('content')
<div class="container">
    @if ($req->type_request == 'join') {!! Form::open(array('class'=>'form-horizontal','url' => 'review')) !!}
	@else {!! Form::open(array('class'=>'form-horizontal','url' => 'hrexit')) !!} @endif
    {!! Form::hidden('type_request',$req->type_request,['id'=>'type_request']) !!}{!! Form::hidden('it_category',6) !!}
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
            @foreach($resulted as $key=>$value)
            <!-- START IT ADMINISTRATOR -->
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
                                {!! Form::checkbox('is_checked['.$key.']['.$item.']',$itemval['item_id'],in_array($itemval['item_id'],$checker) ? 'checked' : '', ($completed != 'Done') ? ['disabled'=>'','class'=>'ace'] : ['class'=>'ace']) !!}
                                <span class="lbl">	 {!! $itemval['item']->name !!} @if($itemval['item']->brand) - {!! $itemval['item']->brand !!} @endif</span>
                            </label>
                            </div>
                            @endforeach
                            <div class="space space-8"></div>
                            <hr />
                            <span class="lbl">@if ($wf_comment[$key]) {!! $wf_comment[$key]->comment !!} @endif</span> 
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
            <div class="form-group">
                {!! Form::label('name', 'Comments', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                <div class="col-sm-9">
                {!! Form::textarea('comment', ($workflow) ? $workflow->comment : '', ['class' => 'form-control']) !!}
                </div>
            </div>    
            </div>
            </div>
            <div class="hr hr-16 hr-dotted"></div>
              <div class="clearfix ">
                <div class="col-md-offset-3 col-md-9">
                <a class="btn btn-primary radius-4 " href="{{ url('/ListOnBoard') }}">Back</a>
                @if($role['role_id']!='1' )
                  @if($completed == 'Done')
               	 @if (!$detail->exit_date && !$req->delivery_date )
                	{!! Form::submit('Submit', ['name'=>'submit','class' => 'btn btn-primary radius-4']) !!}
            		@if ($req->type_request == 'join' ) {!! Form::submit('Completed', ['name'=>'completed','class' => 'btn btn-primary radius-4']) !!} @endif
                  @endif
                  @endif
                 @endif
                </div>
              </div>
        </div>
    </div>
    {!! Form::close() !!}
	
</div>
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
@stop