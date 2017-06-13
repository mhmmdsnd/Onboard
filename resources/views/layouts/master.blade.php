<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta charset="utf-8" />
    <title>Employee On Boarding</title>
	<link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/bootstrap/css/fonts.googleapis.com.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/bootstrap/css/ace.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bootstrap/css/ace-skins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bootstrap/css/ace-rtl.min.css') }}" rel="stylesheet" type="text/css" />
	<script src="{{ asset('/bootstrap/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body class="no-skin">
<!-- START NAVBAR HEADER -->
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a href="/" class="navbar-brand">
                <small><i class="fa fa-leaf"></i> Employee On Boarding</small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
        
        </div>
    </div><!-- /.navbar-container -->
</div>
<!-- END NAVBAR HEADER -->
<!-- START NAVBAR SIDEBAR -->
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>
    <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>
		<ul class="nav nav-list">
            <li class="">
                <a href="#">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>
                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="{{ url('Onboard') }} ">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">HR Form</span>
                </a>
                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="{{ url('ListOnBoard') }} ">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">List Onboard</span>
                </a>
                <b class="arrow"></b>
            </li>
        </ul>
    </div>
	<!-- MAINBAR -->
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row">
                    <div class="col-sx-12">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-success">
                                {{ Session::get('flash_message') }}
                            </div>
                        @endif
                        @yield('main','404 Not Found')
                        @yield('custom-page-script')
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- END MAINBAR -->
</div><!-- /.main-container -->
</body>
</html>