@extends('layouts.emails')
@section('title', 'HR Employee')
@section('content')
<div class="container">
Dear {!! $sent['users']->name !!},<br />
<br />

@if($sent['type_request']=='exit')
With this email, we’ve confirmed that all items owned by, <br />
Name: {!! $sent['name'] !!} <br />
Division: {!! $sent['division'] !!} <br />
Position: {!! $sent['position'] !!} <br />
Have been cleared, <br />
@else
Please review items below:<br />
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
                <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
                <tbody>
                @foreach($admin as $key=>$value)
                    <tr>
                        <td>{!! $value['item']->name !!}</td>
                        <td>OK</td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>											
        </div>                    
    </div>
</div>
<!-- END IT ADMININSTRATOR -->
<!-- START IT ADMINISTRATOR -->
<div class="col-xs-12 col-sm-4">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">IT Infrastructure</h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">  
                <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
                <tbody>
                @foreach($infra as $key=>$value)
                    <tr>
                        <td>{!! $value['item']->name !!}</td>
                        <td>OK</td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>											
        </div>                    
    </div>
</div>
<!-- END IT ADMININSTRATOR -->
<!-- START IT ADMINISTRATOR -->
<div class="col-xs-12 col-sm-4">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">IT Application</h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">  
                <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
                <tbody>
                @foreach($apps as $key=>$value)
                    <tr>
                        <td>{!! $value['item']->name !!}</td>
                        <td>OK</td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>											
        </div>                    
    </div>
</div>
<!-- END IT ADMININSTRATOR -->
</div>
<div class="space-10"></div>
<!-- END ONBOARD DETAIL -->
<!-- START ONBOARD DETAIL -->
<div class="row">
<!-- START IT ADMINISTRATOR -->
<div class="col-xs-12 col-sm-4">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">HR Self-service</h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">  
                <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
                <tbody>
                @foreach($hrself as $key=>$value)
                    <tr>
                        <td>{!! $value['item']->name !!}</td>
                        <td>OK</td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>											
        </div>                    
    </div>
</div>
<!-- END IT ADMININSTRATOR -->
<!-- START IT ADMINISTRATOR -->
<div class="col-xs-12 col-sm-4">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">GA Department</h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">  
                <table id="dt-listhr" class="table table-striped table-bordered table-hover first-table">
                <tbody>
                @foreach($gadept as $key=>$value)
                    <tr>
                        <td>{!! $value['item']->name !!}</td>
                        <td>OK</td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>											
        </div>                    
    </div>
</div>
<!-- END IT ADMININSTRATOR -->
</div>
<div class="space-24"></div>
<!-- END ONBOARD DETAIL -->
<br />
For Detail : <br />
{!! $sent['url'] !!}/review/{!! $sent['request_id'] !!}<br />
<br />
@endif
<br />
Thank you for your cooperation.
</div>
@stop