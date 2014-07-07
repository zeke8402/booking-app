@extends('layout')
@section('content')
<script>
  $(document).foundation({
    abide:{
      patterns:{
        mobile_number:^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$
      }
     }
  });
</script>

<!-- Output correct data for checking -->
<h3> You chose package = {{ $pid }} </h3>
<h3> To be conducted on </h3>
<h3> {{ DateTime::createFromFormat('Y-m-d H:i', $dateRow->booking_datetime )->format('g:ia \o\n l, jS \o\f F Y') }} </h3>

<br><br><br>
<h3> Form: </h3>
<div class="container" id="customerForm">
  
  <!-- Hidden forms to be used later for appointment confirmation -->
{{ Form::open(array('action' => 'BookingController@anyConfirm', 'class' => 'custom', 'data-abide'=>true)) }}
{{ Form::hidden('pid', $pid); }}


<fieldset>
  <legend>Customer Information</legend>
  <div class="row">
        <div class="large-6 columns">
          <label for="fname">First Name <small>required</small>
            <input type="text" name="fname" placeholder="First" required>
          </label>
          <small class="error">Please enter your first name</small>
        </div>
        <div class="large-6 columns">
          <label for="lname">Last Name <small>required</small>
            <input type="text" name="lname" placeholder="Last" required>
          </label>
          <small class="error">Please enter your last name</small>
        </div>
      </div>
      <div class ="row">
        <div class="large-6 columns">
          <label for="number">Contact Number*</label>
            <input type="text" name="number" placeholder="(555)-555-5555" required>
          </label>
        <small class="error">Please enter a properly formatted number.</small>
      </div>
      <div class="large-6 columns">
        <label for="email">Email</label>
          <input type="text" name="email" id="email" placeholder="user@example.com" required>
      </label>
      <small class="error">Please enter a valid e-mail address.</small>
  </div>
</div>
<div class="row">
  <div class="large-12 columns">
    <input id="newsletterBox" name="newsletterBox" type="checkbox" checked><label for="newsletterBox">YES, I want to receive newsletters with this email</label></input>
</div>
</div>
<div class="row">
  <div class="large-12 columns">
        <button type="submit">Submit</button>
      </div>
</div>
    </fieldset> 
 {{ Form::close() }} 
</div>


                
@stop
