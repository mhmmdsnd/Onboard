@extends('layouts.app')
@section('sections', 'Errors')
@section('title', 'Be right back')
@section('content')
<div class="error-container">
<div class="well">
    <h1 class="grey lighter smaller">
        <span class="blue bigger-125">
            <i class="ace-icon fa fa-random"></i>
            405
        </span>
        Something Went Wrong
    </h1>

    <hr />
    <h3 class="lighter smaller">
        But we are working
        <i class="ace-icon fa fa-wrench icon-animated-wrench bigger-125"></i>
        on it!
    </h3>

    <div class="space"></div>

    <div>
        <h4 class="lighter smaller">Meanwhile, Please contact Yanto / 083815010025 / heryanto@sinarmasmining.com </h4>
    </div>

    <hr />
    <div class="space"></div>

    <div class="center">
        <a href="javascript:history.back()" class="btn btn-grey">
            <i class="ace-icon fa fa-arrow-left"></i>
            Go Back
        </a>

        <a href="{{ url('/ListOnBoard') }}" class="btn btn-primary">
            <i class="ace-icon fa fa-tachometer"></i>
            Dashboard
        </a>
    </div>
</div>
</div>
@stop