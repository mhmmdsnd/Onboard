@extends('layouts.app')
@section('sections', 'Errors')
@section('title', 'Errors 403')
@section('content')
<div class="error-container">
<div class="well">
    <h1 class="grey lighter smaller">
        <span class="blue bigger-125">
            <i class="ace-icon fa fa-random"></i>
            403
        </span>
        You are not authorized.
    </h1>

    <hr />
    <h3 class="lighter smaller">
        <i class="ace-icon fa fa-wrench icon-animated-wrench bigger-125"></i>
        Please contact Yanto / 083815010025 / heryanto@sinarmasmining.com
    </h3>

    <div class="space"></div>

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