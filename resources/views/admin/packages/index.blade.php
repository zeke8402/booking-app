@extends('admin/layout')
@section('content')
<div class="container">
	<div class="row">
		<legend>Packages</legend>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>Duration</th>
					<th>Description</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($packages as $p)
				<tr>
					<td>{{ $p->package_name }}</td>
					<td>{{ '$'.$p->package_price }}</td>
					<td>{{ $p->package_time.' hours' }}</td>
					<td>{{ $p->package_description }}</td>
					<td><a href="{{ url('admin/edit-package/'.$p->id) }}" class="btn btn-primary">Edit</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection