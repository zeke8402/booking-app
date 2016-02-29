@extends('admin/layout')
@section('content')
<div class="container">
	<h1>Configuration</h1>
</div>

<div class="row">
	<div class="container">
		<legend>Time Intervals</legend>
		<p> When setting availability. the application will use this interval to segment the available appointment dates.</p>
		<p>The time interval is currently set to <strong>{{ $configuration->timeInterval->interval }} </strong> {{ $configuration->timeInterval->metric }} </p>
		{!! Form::open(['action' => 'AdminController@anySetTime', 'class' => 'form-horizontal', 'data-abide' => true]) !!}
	</div>
</div>

@endsection