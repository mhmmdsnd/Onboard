Hi {!! $users['onboard']->name !!},<br />
<br />
We are from IT division. It is our pleasure to welcome you to the {!! $users['onboard']['subdivision']->name !!}  at {!! $users['onboard']['company']->name !!}.
If you need any assistance in IT related matter, please contact:
<br />
<!-- START ONBOARD DETAIL -->
<div class="row">
    <div class="col-sm-9">
        <div>
            <ul class="list-unstyled spaced">
                <li>
                    <i class="ace-icon fa fa-caret-right blue"></i>Name : <b class="red">Fathia Justin
                    </b>
                </li>
                <li>
                    <i class="ace-icon fa fa-caret-right blue"></i>Phone : <b class="red">+62811-9109-100</b>
                </li>
                <li>
                    <i class="ace-icon fa fa-caret-right blue"></i>Ext : <b class="red">xxxx</b>
                </li>
                 <li>
                    <i class="ace-icon fa fa-caret-right blue"></i>Email : <b class="red">fathia.justine@sinarmasmining.com</b>
                </li>
                <li>
                    <i class="ace-icon fa fa-caret-right blue"></i>Location : <b class="red">Menara Prima, Lt. 17, near Musholla. Lingkar Mega Kuningan, Kuningan.</b>
                </li>
             </ul>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
<div class="row">
We�ve prepared few items for you, please refer to link below: <br />
{!! $users['url'] !!}/Users/{!! $users['id'] !!}<br />
</div>
<div class="row">
	<div class="col-sm-9">
    	Credential for login
    </div>
    <div class="col-sm-9">
        <div>
            <ul class="list-unstyled spaced">
                <li>
                    <i class="ace-icon fa fa-caret-right blue"></i>Username : <b class="red">{!! $users['onboard']->email !!}</b>
                </li>
                <li>
                    <i class="ace-icon fa fa-caret-right blue"></i>Password : <b class="red">123456</b>
                </li>
             </ul>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
<div class="space-24"></div>
<!-- END ONBOARD DETAIL -->
<br />
Hope enjoy your work.