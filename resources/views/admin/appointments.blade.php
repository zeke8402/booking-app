@extends('admin/layout')
@section('content')
<div class="col-lg-10">
	<div id="error"></div>
	<div id="calendar"></div>
</div>
<div class="col-lg-2">
	<legend> Details </legend>
	<div id="appointment-details">
		<p>Click on an appointment to show details.</p>
	</div>
</div>

<script src="{{ asset('/js/admin/appointments.js') }}"></script>

@endsection