@extends('layout')
@section('content')
<br><br><br>
<div class="row">
  <ul class="pricing-table">
    <li class="title">Confirm Appointment</li>
    <li class="price">
      {{ $packageName }} <br>
      <h4> With Person on {{ date('l jS \of F Y', strtotime($input['bdate'])) }} at {{ date('h:i:s A', strtotime($input['time'])) }}</h4>
      <h4><small>{{ link_to('/', 'Change'); }}</small></h4>
    </li>
    <li class="bullet-item">
        <table class="confirmation-table" width="100%">
          <thead>
            <tr>
              <th> Name </th>
              <th> Phone Number </th>
              <th align="center"> Email </th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> {{ $input['fname'] }} {{ $input['lname'] }} </td>
              <td> {{ $input['number'] }} </td>
              <td> {{ $input['email'] }} </td>
              <td> <a href="#"> Edit Details </a></td>
            </tr>
          </tbody>
      </table>
    </li>
<li class="bullet-item">
  <a href="confirmed" class="button">Confirm Appointment</a>
</li>
  </ul>
</div>
      
@stop