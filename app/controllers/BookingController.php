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
    
   // DO NOT DELETE THESE COMMENTS
   // This is the query to use MySQL functions to parse the date variables
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
    $time = BookingTimes::find($aptTimeID);
    Session::put('aptTime', $time->booking_time);
    
    return View::make('customerInfo')->with('pid', Session::get('packageID'))->with('bdate', $aptDate)->with('time', $time->booking_time);
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
    
    // Only save customer if the email does not already exist
    // Using validator 
    // Must not already exist in the `email` column of `users` table
    $rules = array('email' => 'unique:customers,email');

    $validator = Validator::make(
      array(
        'first_name' => Session::get('fname'),
        'last_name' => Session::get('lname'),
        'email' => Session::get('email')
      ),
      array(
        'first_name' => 'exists:customers,first_name',
        'last_name' => 'exists:customers,last_name',
        'email' => 'exists:customers,email'
      )
    );

    if ($validator->fails()) {
      // Register the new user or whatever.
      $customer = new Customer;
      $customer->first_name = Session::get('fname');
      $customer->last_name = Session::get('lname');
      $customer->contact_number = Session::get('number');
      $customer->email = Session::get('email');
      $customer->wants_updates = Session::get('updates');
      $customer->save();
      $customerID = $customer->id;
    } else {
      // Get the customer id of the email
      $customerID = DB::table('customers')->where('email', Session::get('email'))->pluck('id');
    }
    
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
    BookingTimes::date(Session::get('aptDate'))->between($aptDateTime->format("H:i"), $endDateTime->format("H:i"))->delete();
    
    
    // Remove date if no more times remain
    $result = BookingTimes::date(Session::get('aptDate'));
    if(!$result->first()) {
      BookingDates::where('booking_date', Session::get('aptDate'))->delete();
    }
  
    return View::make('success')->with('starttime', $aptDateTime)->with('endtime', $endDateTime)->with('result', $result);
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