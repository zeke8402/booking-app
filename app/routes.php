<?php

//testing branch capatbilities again
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'BookingController@getIndex');
Route::controller('booking', 'BookingController');

/***************** CUSTOMER CONFIRMATION VIEW *******************
// This Route takes the appointment details and customer details, adds them to the database, and asks for confirmation
// Before setting it in stone, we want it to roll back if they cancel
Route::any('confirm', array('as' => 'customer.input', function() {
  
  $input = Input::all();
  Session::put('fname', $input['fname']);
  Session::put('lname', $input['lname']);
  Session::put('number', $input['number']);
  Session::put('email', $input['email']);
  
  //Check if newsletterbox is checked, then add shit to database
  if($input['newsletterBox']) {
    Session::put('updates', '1');
  } else {
    Session::put('updates', '0');
  }
  
  $packageName = DB::table('packages')->where('id', $input['pid'])->pluck('package_name');
  
  return View::make('confirm')->with('input', $input)->with('packageName', $packageName);

})); */

/***************** APPOINTMENT SUCCESS VIEW **********************/
Route::any('confirmed', array('as' => 'confirmed', function() {

  $customer = new Customer;
  $customer->first_name = Session::get('fname');
  $customer->last_name = Session::get('lname');
  $customer->contact_number = Session::get('number');
  $customer->email = Session::get('email');
  $customer->wants_updates = Session::get('updates');
  $customer->save();
  
  // We need to create the appointment here, and remove the time booked, remove the day if no times remain, and remove all times that conflict with the time the package takes to complete.
  
  // We can call a booking time model function to remove the date, and any dates conflicting with the package, such as
  // BookingTimes::removeTimes($timeID, $packageID);
  
  
  return View::make('success');
}));
