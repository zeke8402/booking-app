<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'BookingController@getIndex');
Route::controller('booking', 'BookingController');
Route::controller('admin', 'AdminController');

// API Routes
Route::group(['prefix' => 'api'], function()
{
	Route::get('get-available-days', 'APIController@GetAvailableDays');
});
