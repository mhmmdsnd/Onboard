@extends('layouts.app')
@section('sections', 'Onboard Report')
@section('title', 'Onboard Report - Onboard')
@section('content')
<div class="container">
	{!! Form::open(array('class'=>'form-horizontal','id'=>'slareport')) !!}
    
    {!! Form::close() !!}        
</div>
@stop
@section('custom-page-script')
<link href="{{ asset('/bootstrap/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('/bootstrap/js/Chart.bundle.js') }}"></script>
@stop
