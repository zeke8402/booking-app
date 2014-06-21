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

/***************** CUSTOMER CONFIRMATION VIEW ********************/
// This Route takes the appointment details and customer details, adds them to the database, and asks for confirmation
// Before setting it in stone, we want it to roll back if they cancel
Route::any('confirm', array('as' => 'customer.input', function() {
  
  $input = Input::all();
  $packageName = DB::table('packages')->where('id', $input['pid'])->pluck('package_name');
  
  return View::make('confirm')->with('input', $input)->with('packageName', $packageName);

}));

/***************** APPOINTMENT SUCCESS VIEW **********************/
Route::any('confirmed', array('as' => 'confirmed', function() {
    return View::make('success');
}));





// Route for GET and POST for getting the times associated with a particular date
/* This is called with AJAX for clicking a date on the datepicker
Route::any('getTimes', function() {
 
  //We get the POST from AJAX for the selected day, and we get the available times with that parameter from the DB
  $selectedDay = Input::get('selectedDay');
  $availableTimes = DB::select('SELECT id, booking_time FROM booking_times WHERE booking_date="'.$selectedDay.'"');
  
  return Response::make(View::make('getTimes')->with('selectedDay', $selectedDay)->with('availableTimes', $availableTimes), 200, array('Content-Type' => 'application/json'));
}); */

