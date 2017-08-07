@extends('layouts.app')
@section('title', 'Employee Detail')
@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {!! Form::open(array('class'=>'form-horizontal')) !!}
    <div class="col-sm-10 col-sm-offset-1">
	<div class="widget-box transparent">
		<div class="widget-header widget-header-large">
			<h3 class="widget-title grey lighter">
				<i class="ace-icon fa fa-leaf green"></i>
				Data Employee : {!! $detail->name !!}
			</h3>
            <div class="widget-toolbar no-border invoice-info">
                <span class="invoice-info-label">Join Date :</span>
                <span class="blue">{!! Carbon\Carbon::parse($detail->joindate)->format('d F Y') !!}</span>
                <br />
                @if ($detail->exit_date) 
                <span class="invoice-info-label">Exit Date :</span>
                <span class="red">{!! Carbon\Carbon::parse($detail->clearance_date)->format('d F Y') !!}</span>
                @endif
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
                                <i class="ace-icon fa fa-caret-right blue"></i>Company : <b class="red">@if($detail->company_id){!! $detail['company']->name !!}@endif</b>
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
            <h4 class="pink">
                <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                <a href="#modal-table" role="button" class="green" data-toggle="modal"> View Log</a>
            </h4>
            <div class="space"></div>
            <h3 class="header smaller lighter blue">
                <i class="ace-icon fa fa-leaf green"></i> Detail
            </h3>
            <!-- START ONBOARD DETAIL -->
            @foreach($result->chunk(3) as $resulted)
            <div class="row">
            <!-- START IT -->
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
                            {!! Form::checkbox('is_checked['.$key.']['.$item.']',$itemval['item_id'],'checked', ['disabled'=>'','class'=>'ace']) !!}        
                            <span class="lbl">
                            {!! $itemval['item']->name !!} @if($itemval['item']->brand) - {!! $itemval['item']->brand !!} @endif</span>
                        </label>
                        </div>
                      @endforeach
                      </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- END IT -->
            </div>
            @endforeach
            <!-- END ONBOARD DETAIL -->
            <div class="space-24"></div>
            
            </div>
            </div>
            <div class="hr hr-16 hr-dotted"></div>
              <div class="clearfix ">
                <div class="col-md-offset-3 col-md-9">
                <a class="btn btn-primary radius-4 " href="{{ url('/employee') }}">Back</a>
                </div>
              </div>
        </div>
    </div>
    {!! Form::close() !!}
	<!-- START VIEW LOG -->
    @if ($activity)
    <div id="modal-table" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">&times;</span>
                    </button>
                    Results for update log
                </div>
            </div>
            <div class="modal-body no-padding">
                <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                    <thead>
                        <tr>
                            <th><i class="ace-icon fa fa-clock-o bigger-110"></i>Update</th>
                            <th>User</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($activity as $key=>$value)
                        <tr>
                            <td>{!! $value->created_at !!}</td>
                            <td>{!! $value->user_id !!}</td>
                            <td>{!! $value->details !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer no-margin-top">
                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Close
                </button>
            </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    @endif
    <!-- END VIEW LOG -->
</div>
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
@stop
