<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta charset="utf-8" />
    <title>Human Resource - @yield('title')</title>
	<link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/bootstrap/css/fonts.googleapis.com.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/bootstrap/css/ace.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bootstrap/css/ace-skins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bootstrap/css/ace-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body class="no-skin">
<!-- MAINBAR -->
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row">
                    <div class="col-sx-12">
                        @yield('content','404 Not Found')
                        @yield('custom-page-script')
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- END MAINBAR -->
</body>
</html>