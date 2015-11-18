@extends('admin/layout')
@section('content')
<div class="col-md-8 col-md-offset-2">
	<div id="error"></div>
	<div id="calendar"></div>
</div>

<script src="{{ asset('/js/admin/appointments.js') }}"></script>
@endsection