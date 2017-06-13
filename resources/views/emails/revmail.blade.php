Dear {!! $sent['users']->name !!},<br />
<br />
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
                @foreach($suggested as $key=>$value)
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
<div class="space-24"></div>
<!-- END ONBOARD DETAIL -->
<br />
{!! $sent['url'] !!}/Review/{!! $sent['request_id'] !!}<br />
<br />
<br />
Thank you for your cooperation.