@extends('layout')
@section('content')
<br><br><br>
<div class="row">
  <ul class="pricing-table">
    <li class="title">Confirm Appointment</li>
    <li class="price">
   
      <h4> With Person on {{ DateTime::createFromFormat('Y-m-d H:i', $appointmentInfo['datetime'] )->format('g:ia \o\n l, jS \o\f F Y') }} </h4>
      <h4><small>{{ link_to('/', 'Change'); }}</small></h4>
    </li>
    <li class="bullet-item">
        <table class="confirmation-table" width="100%">
          <thead>
            <tr>
              <th> Name </th>
              <th> Phone Number </th>
              <th align="center"> Email </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> {{ $appointmentInfo['fname'] }} </td>
              <td> {{ $appointmentInfo['lname'] }} </td>
              <td> {{ $appointmentInfo['email'] }} </td>
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