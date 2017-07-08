<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Human Resource</title>
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
   	<link href="{{ asset('/bootstrap/css/fonts.googleapis.com.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/bootstrap/css/ace.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bootstrap/css/ace-skins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bootstrap/css/ace-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Styles -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <!-- JavaScripts -->
	<script src="{{ asset('/bootstrap/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/ace.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/ace-extra.min.js') }}"></script>
   
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
            <a href="#" class="navbar-brand">
                <small><i class="fa fa-leaf"></i> Human Resource</small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
        	<ul class="nav ace-nav">
            	@if (Auth::guest())
                
                @else
                <li class="light-blue dropdown-modal">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    	<img class="nav-user-photo" src="{{ asset('/bootstrap/images/avatar2.png') }}" alt="" />
                        <span class="user-info">
                            <small>Welcome, </small>{{ Auth::user()->name }}</span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close" role="menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
            	</li>
             @endif
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>
<!-- END NAVBAR HEADER -->
<!-- START NAVBAR SIDEBAR -->
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>
    @if (!Auth::guest())
    <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>
		<ul class="nav nav-list">
		    @role(['admin','hr-rct','hr'])
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text">
                       Employee
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
            	<b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="{{ url('employee') }}">
                            <i class="menu-icon fa fa-caret-right"></i>List
                        </a>
                        <b class="arrow"></b>
                    </li>
                    @role(['admin','hr-rct'])
                    <li class="">
                        <a href="{{ url('onboard') }}">
                            <i class="menu-icon fa fa-caret-right"></i>New
                        </a>
                        <b class="arrow"></b>
                    </li>
                    @endrole
                </ul>
			</li>
            @endrole
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text">
                        Request
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
            	<b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="{{ url('ListOnBoard') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Onboard</a>
                        <b class="arrow"></b>
                    </li>
                    @role(['admin','hr','itadmin','itinfra','itapps','ga','hr-rct'])
                    <li class="">
                        <a href="{{ url('hrexit') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Exit</a>
                        <b class="arrow"></b>
                    </li>
                    @endrole
                </ul>
			</li>
            @role('admin')
            <li class="">
            	<a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text">
                       SLA Report
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
            	<b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="{{ url('slareport') }}">
                            <i class="menu-icon fa fa-caret-right"></i>Onboard</a>
                        <b class="arrow"></b>
                    </li>
                   </ul>
			</li>
            @endrole
        </ul>
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
	</div>
    @endif
    <!-- MAINBAR -->
    <div class="main-content">
        <div class="main-content-inner">
        	@if (!Auth::guest())
        	<div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        @yield('sections')
                    </li>
                    <li class="active">@yield('title')</li>
                </ul><!-- /.breadcrumb -->
            </div>
            @endif
            <div class="page-content">
                <div class="row">
                    <div class="col-sx-12">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-success">
                                {{ Session::get('flash_message') }}
                            </div>
                        @endif
                        @yield('content','404 Not Found')
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- END MAINBAR -->
</div>
@yield('custom-page-script')
</body>
</html>