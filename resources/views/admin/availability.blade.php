@extends('admin/layout')
@section('content')
<div class="col-md-offset-2 col-md-8">
	<div id="error"></div>
	<div id="calendar"></div>
</div>
<script src="{{ asset('/js/admin/availability.js') }}"></script>
@endsection