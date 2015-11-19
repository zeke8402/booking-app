@extends('admin/layout')
@section('content')

<div class="container">
	<div class="row text-center">
		<legend>Edit Package</legend>
		  {!! Form::model($package, array('route' => array('package.update', $package->id))) !!}

        <!-- name -->
        {!! Form::label('package_name', 'Name') !!}
        {!! Form::text('package_name') !!}

        <!-- price -->
        {!! Form::label('package_price', 'Price') !!}
        {!! Form::number('package_price') !!}

        {!! Form::label('package_time', 'Time') !!}
        {!! Form::number('package_time') !!}

				<br>
        {!! Form::label('package_description', 'Description') !!}
        <br>
        {!! Form::textarea('package_description') !!}
				<br>
        {!! Form::button('Update Package', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
	</div>
</div>
@endsection