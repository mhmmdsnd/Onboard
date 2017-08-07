@extends('layouts.emails')
@section('title', 'HR Employee')
@section('content')
<div class="container">
Dear  {!! $data['wf_name'] !!},<br />
<br />
@if($data['type_request']=='exit')
Please clear all items that owned by, <br />
Name : {!! $data['name'] !!} <br />
Division : {!! $data['division'] !!} <br />
Level : {!! $data['position'] !!} <br />
For detail please visit,<br />
{!! $data['url'] !!}/{!! $data['user_type'] !!}/{!! $data['request_id'] !!}<br />
@else

New employee submitted to onboard <br />
Nama : {!! $data['name'] !!}<br />
Company : {!! $data['company'] !!}<br />
Division : {!! $data['division'] !!}<br />
Department {!! $data['department'] !!}: <br />
Level : {!! $data['position'] !!} <br />
Grade : {!! $data['grade'] !!} <br />
Title : {!! $data['title'] !!} <br />
Request By : {!! $data['request_name'] !!} <br />
Requester Email : {!! $data['request_email'] !!} <br />
Join Date : {!! $data['join_date'] !!} <br />
Workplace : {!! $data['workplace'] !!}<br />

Please prepare these items for new on-boarding employee refer to link below:<br />
<br />
{!! $data['url'] !!}/{!! $data['user_type'] !!}/{!! $data['request_id'] !!}<br />
<br />
@endif
<br />
Thank you for your cooperation.<br /><br />
Please contact Yanto / 083815010025 / heryanto@sinarmasmining.com for any assistance.<br />
</div>
@stop