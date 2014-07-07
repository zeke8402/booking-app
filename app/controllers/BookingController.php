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
    
    // This groups all booking times by date so we can give a list of all days available.
    $days = DB::select("SELECT id, strftime('%Y-%m-%d', booking_datetime) AS bdate FROM booking_datetimes GROUP BY bdate");
    
    return View::make('BookAppointment')->with('days', $days)->with('packageName', $packageName);
  }
  
  /** 
  * Function to get customer details after Date & Time pick
  *
  * User inputs their information to continue
  *
  **/
  public function getDetails($aptID) {
    
    // Put the passed date time ID into the session
    Session::put('aptID', $aptID);
    
    // Get row of date id
    $dateRow = BookingDateTimes::find($aptID);
    Session::put('selection', $dateRow->booking_datetime);
    
    return View::make('customerInfo')->with('pid', Session::get('packageID'))->with('dateRow', $dateRow)->with('aptID', $aptID);
    
  }
  
  /**
  * Function to post customer info and present confirmation view
  *
  * User Confirms appointment details to continue
  *
  **/
  public function anyConfirm() {
  
  $input = Input::all();
  $appointmentInfo = array (
    "package_name" => Package::find(Session::get('packageID'))->pluck('package_name'),
    "date"         => Session::get('selection'),
    "fname"        => $input['fname'],
    "lname"        => $input['lname'],
    "number"       => $input['number'],
    "email"        => $input['email']
  );

  Session::put('appointmentInfo', $appointmentInfo);
  
  //Check if newsletterbox is checked, then add shit to database
  if($input['newsletterBox']) {
    Session::put('updates', '1');
  } else {
    Session::put('updates', '0');
  }
  
  $packageName = DB::table('packages')->where('id', $input['pid'])->pluck('package_name');
  
  //return View::make('confirm')->with('input', $input)->with('packageName', $packageName);
  return View::make('confirm')->with('appointmentInfo', $appointmentInfo);

  }
  
  /**
   * Function to create the appointment, scrub the database, and send out an email confirmation
   *
   * User interaction is complete
   *
   **/
  // This will take the place of anyConfirmed
  public function anyConfirmed() {
    
    $newCustomer = Customer::addCustomer();
    return View::make('test')->with('test', $newCustomer);

  }
  
  /**
   * Function to add the appointment to database, do scrubbing, and email confirmations
   *
   * User interaction is complete
   *
   
  public function anyConfirmed() {
    
    
    // Creating the appointment
    // Required params, id, customer_id, appointment_type, appointment_date, appointment_time
    $appointment = new Appointment;
    $appointment->customer_id = $customerID;
    $appointment->appointment_type = Session::get('packageID');
    $appointment->appointment_datetime = date('Y-m-d H:i', strtotime(Session::get('aptDate').' '.Session::get('aptTime')));
    $appointment->appointment_date = Session::get('aptDate');
    $appointment->appointment_time = Session::get('aptTime');
    $appointment->save();
    
    // Grab the end time of the package, and run booking times through
    // If time >= appointment time and <= ending time, remove that time
    // This will also remove the time booked.
    
    // Remove all the times after the time booked that would overlap the appointment duration
    $aptDateTime = date('Y-m-d H:i', strtotime(Session::get('aptDate').' '.Session::get('aptTime')));
    $aptDateTime = DateTime::createFromFormat('Y-m-d H:i', $aptDateTime);
    $package = Package::find(Session::get('packageID'));
    $packageDuration = $package->package_time.' '.$package->time_metric;
    
    $endDateTime = new DateTime($aptDateTime->format('Y-m-d H:i:s'));
    $endDateTime = date_add($endDateTime, date_interval_create_from_date_string($packageDuration.' hours'));
    
    // Remove all times that would conflict with the appointment
    BookingTimes::date(Session::get('aptDate'))->between($aptDateTime->format("H:i:s"), $endDateTime->format("H:i:s"))->delete();
    
    
    // Remove date if no more times remain
    $result = BookingTimes::date(Session::get('aptDate'));
    if(!$result->first()) {
      BookingDates::where('booking_date', Session::get('aptDate'))->delete();
    }
  
    return View::make('success')->with('starttime', $aptDateTime)->with('endtime', $endDateTime)->with('result', $result);
  }
*/
  /**
  * Function to retrieve times available for a given date
  *
  * View is returned in JSON format
  *
  **/
  public function getTimes() {
    
    // We get the data from AJAX for the day selected, then we get all available times for that day
    $selectedDay = Input::get('selectedDay');
    
    $availableTimes = DB::select('SELECT id, strftime("%H:%M", booking_datetime) AS bdate FROM booking_datetimes WHERE strftime("%Y-%m-%d", booking_datetime)="'.$selectedDay.'"');
    //$availableTimes = BookingDateTimes::date($selectedDay);
    
    return Response::make(View::make('getTimes')->with('selectedDay', $selectedDay)->with('availableTimes', $availableTimes), 200, array('Content-Type' =>     'application/json'));

  }
}