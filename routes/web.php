<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');
//Route::get('appointment', 'BookingController@getIndex');
Route::get('appointment', 'BookingController@getCalendar');
Route::get('booking/times', 'BookingController@getTimes');
Route::get('booking/details/{id}', 'BookingController@getDetails');
Route::post('anyConfirm', 'BookingController@anyConfirm');
Route::get('confirmed', 'BookingController@anyConfirmed');
Route::get('anySetTime', 'AdminController@anySetTime');


// Customer API Routes
Route::get('api/get-available-days', 'APIController@GetAvailableDays');

// Admin API Routes
Route::group(['prefix' => 'api','middleware'=>'auth'], function()
{
	Route::get('get-all-appointments', 'AdminAPIController@GetAllAppointments');
	Route::get('get-appointment-info/{id}', 'AdminAPIController@GetAppointmentInfo');
	Route::get('get-all-availability', 'AdminAPIController@GetAllAvailability');
	Route::post('set-availability', 'AdminAPIController@SetAvailability');
});

// Admin Routes
Route::group(['prefix' => 'admin','middleware'=>'auth'], function()
{
	Route::get('/', 'AdminController@appointments');

	// Appointment Routes
	Route::get('appointments', 'AdminController@appointments');

	// Availability Routes
	Route::get('availability', 'AdminController@availability');
	Route::post('add/availability', 'AdminController@addAvailability');

	// Configuration Routes
	Route::get('configuration', 'AdminController@configuration');

	// Package Routes
	Route::get('packages', 'AdminController@packages');
	Route::get('edit-package/{package_id}', 'AdminController@editPackage');
	Route::post('update-package/{package_id}', array('as' => 'package.update'), 'AdminController@updatePackage');

	Route::get('sendsms', 'AdminController@sendsms');

});