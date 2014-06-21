<?php

class BookingController extends BaseController {
  
  // Function to retrieve the index page
  // User selects package to continue
  public function getIndex() {
	  $packages = Package::all();
    return View::make('showPackages')->with('packages', $packages);
	}

  // Function to retrieve datepicker
  // User selects date + time to continue
  public function getCalendar($pid) {
    
    //$packageName = DB::table('packages')->where('id', $pid)->pluck('package_name');
    $packageName = Package::find($pid)->pluck('package_name');
    $days = DB::select('SELECT id, year(booking_date) AS byear, month(booking_date) AS bmonth, day(booking_date) AS bday, booking_date AS bdate FROM booking_dates');
    
    return View::make('BookAppointment')->with('days', $days)->with('packageName', $packageName);
  }
  
  public function getTimes() {
    
    //We get the POST from AJAX for the selected day, and we get the available times with that parameter from the DB
    $selectedDay = Input::get('selectedDay');
    $availableTimes = DB::select('SELECT id, booking_time FROM booking_times WHERE booking_date="'.$selectedDay.'"');
  
    return Response::make(View::make('getTimes')->with('selectedDay', $selectedDay)->with('availableTimes', $availableTimes), 200, array('Content-Type' =>     'application/json'));
  }
}