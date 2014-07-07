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
    
    $package = Package::find($pid);
    
    // This groups all booking times by date so we can give a list of all days available.
    $days = DB::select("SELECT id, strftime('%Y-%m-%d', booking_datetime) AS bdate FROM booking_datetimes GROUP BY bdate");
    
    return View::make('BookAppointment')->with('days', $days)->with('packageName', $package->package_name);
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
  $package = Package::find(Session::get('packageID'));
  
  $appointmentInfo = array (
    "package_id"   => Session::get('packageID'),
    "package_name" => $package->package_name,
    "package_time" => $package->package_time,
    "datetime"     => Session::get('selection'),
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
    
    $info = Session::get('appointmentInfo');
    $startTime = DateTime::createFromFormat('Y-m-d H:i', $info['datetime'] )->format('Y-m-d H:i');
    $endTime = new DateTime($info['datetime']);
    date_add($endTime, date_interval_create_from_date_string($info['package_time'].' hours'));
    $newCustomer = Customer::addCustomer();
    $endTime = $endTime->format('Y-m-d H:i');
    
    // Create the appointment with this new customer id
    Appointment::addAppointment($newCustomer);
    
    // Remove all dates conflicting with the appointment duration
    BookingDateTimes::timeBetween($startTime, $endTime)->delete();
  }
  
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

    // Now we have to cross-reference this data with our appointments table, and mask any dates that might cause a conflict
    
    return Response::make(View::make('getTimes')->with('selectedDay', $selectedDay)->with('availableTimes', $availableTimes), 200, array('Content-Type' =>     'application/json'));

  }
}