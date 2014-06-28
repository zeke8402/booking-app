<?php

class BookingController extends BaseController {
  
  /**
  * Function to retrieve the index page
  *
  * User selects package to continue
  *
  **/
  public function getIndex() {
	  $packages = Package::all();
    return View::make('showPackages')->with('packages', $packages);
	}

  /**
  * Function to retrieve datepicker
  *
  * User selects date + time to continue
  **/
  public function getCalendar($pid) {
    
    //Add package to the session data
    Session::put('packageID', $pid);
    
    $packageName = Package::find($pid)->pluck('package_name');
    
    //This is the query to use MySQL functions to parse the date variables
   // $days = DB::select('SELECT id, year(booking_date) AS byear, month(booking_date) AS bmonth, day(booking_date) AS bday, booking_date AS bdate FROM booking_dates');
    
    $days = DB::select("SELECT id, strftime('%Y', booking_date) AS byear, strftime('%m', booking_date) AS bmonth, strftime('%d', booking_date) AS bday, booking_date AS bdate FROM booking_dates");
    
    return View::make('BookAppointment')->with('days', $days)->with('packageName', $packageName);
  }
  
  /** 
  * Function to get customer details after Date & Time pick
  *
  * User inputs their information to continue
  *
  **/
  public function getDetails($aptDate, $aptTimeID) {
    
    // Put Date & Time Selected in the Session
    Session::put('aptDate', $aptDate);
    Session::put('aptTimeID', $aptTimeID);
    
    // Retrieving the real time using the time ID parameter
    $time = BookingTimes::find($aptTimeID)->pluck('booking_time');
    
    return View::make('customerInfo')->with('pid', Session::get('packageID'))->with('bdate', $aptDate)->with('time', $time);
    
    
  }
  
  /**
  * Function to post customer info and present confirmation view
  *
  * User Confirms appointment details to continue
  *
  **/
  public function anyConfirm() {
  
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

  }
  
  /**
   * Function to add the appointment to database, do scrubbing, and email confirmations
   *
   * User interaction is complete
   *
   **/
  public function anyConfirmed() {
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
  }

  /**
  * Function to retrieve times available for a given date
  *
  * View is returned in JSON format
  *
  **/
  public function getTimes() {
    
    //We get the POST from AJAX for the selected day, and we get the available times with that parameter from the DB
    $selectedDay = Input::get('selectedDay');
    $availableTimes = DB::select('SELECT id, booking_time FROM booking_times WHERE booking_date="'.$selectedDay.'"');
  
    return Response::make(View::make('getTimes')->with('selectedDay', $selectedDay)->with('availableTimes', $availableTimes), 200, array('Content-Type' =>     'application/json'));
  }
}