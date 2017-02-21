@extends('layout')
@section('content')

<!-- Output correct data for checking -->
<div class="jumbotron text-center">
  <h3> To be conducted on </h3>
  <h3> {{ $dateFormat }} </h3>

</div>
<br><br><br>
<!-- <div class="col-md-6 center-block" style="float:none;"> -->
<div class="row col-md-6 center-block" style="float:none;">
    
  
  <!-- Hidden forms to be used later for appointment confirmation -->
{!! Form::open(array('action' => 'BookingController@anyConfirm', 'class' => 'form-horizontal', 'data-abide'=>true)) !!}

<fieldset>
  <legend>Customer Information</legend>

  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  
  <!-- First Name Input -->
  <div class="form-group">
    <label for="fname" class="col-lg-2 control-label">First Name</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" name="firstName" id="fname" placeholder="First Name">
    </div>
  </div>
  
  <!-- Last Name Input -->
  <div class="form-group">
    <label for="lname" class="col-lg-2 control-label">Last Name</label>
    <div class="col-lg-10">
       <input type="text" class="form-control" name="lastName" id="lname" placeholder="Last Name">
    </div>
  </div>
  
  <!-- Contact Number -->
  <div class="form-group">
    <label for="number" class="col-lg-2 control-label">Contact Number</label>
    <div class="col-lg-10">
       <input type="text" class="form-control" name="contactNumber" id="number" placeholder="012xxxxxxx">
    </div>
  </div>

   <!-- Identity -->
  <div class="form-group">
    <label for="number" class="col-lg-2 control-label">IC/Passport No.</label>
    <div class="col-lg-10">
       <input type="text" class="form-control" name="identityNumber" id="identity" placeholder="IC/ Passport Number">
    </div>
  </div>

  <!-- Email -->
   <div class="form-group">
    <label for="email" class="col-lg-2 control-label">E-Mail</label>
    <div class="col-lg-10">
       <input type="text" class="form-control" name="email" id="email" placeholder="you@example.com">
    </div>
  </div>
<div class="form-group">
        <label for="service-type" style="float:left;padding: 6px 12px 2px 12px;" class="col-lg-2 control-label">Appointment Type</label>
        <select id="service-type" name="service_type" style="width:auto;" class="form-control selectWidth">
          <option value="General Walk-In">General Walk-In</option>
          <option value="Pregnancy">Pregnancy</option>
          <option value="Blood Test">Blood Test</option>
          <option value="Others">Others</option>
        </select>
  </div>
  
  <div class="form-group">
        <label for="package" style="float:left;padding: 6px 12px 2px 12px;" class="col-lg-2 control-label">Number of patients</label>
        <select id="package" name="package" style="width:auto;" class="form-control selectWidth">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
  </div>
  
  <div class="checkbox text-center">
      <label>
        <input id="newsletterBox" name="newsletterBox" type="checkbox" checked> YES, I want to receive newsletters with this email</input>
    </label>
  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  
 
  </div>
  
   {!! Form::close() !!} 
@stop

<br><br><br><br>
