@extends('layouts.emails')
@section('title', 'HR Employee')
@section('content')
<div class="container">
Dear  {!! $data['itname'] !!},<br />
<br />
@if($data['type_request']=='exit')
Please clear all items that owned by, <br />
Name: {!! $data['name'] !!} <br />
Division: {!! $data['division'] !!} <br />
Position: {!! $data['position'] !!} <br />
For detail please visit,<br />
{!! $data['url'] !!}/{!! $data['user_type'] !!}/{!! $data['request_id'] !!}<br />
@else
Please prepare these items for new on-boarding employee refer to link below:<br />
<br />
{!! $data['url'] !!}/{!! $data['user_type'] !!}/{!! $data['request_id'] !!}<br />
<br />
@endif
<br />
Thank you for your cooperation.<br />
</div>