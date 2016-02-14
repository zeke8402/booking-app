@extends('admin/layout')
@section('content')
<div class="col-lg-8">
	<div id="error"></div>
	<div id="calendar"></div>
</div>
<div class="col-lg-4">
	<legend> Details </legend>
	<div id="availability-details">
		@include('admin.setAvailability')
	</div>
</div>

<script src="{{ asset('/js/admin/availability.js') }}"></script>
@endsection