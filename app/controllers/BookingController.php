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
    $package = Package::find(Session::get('packageID'));
    
    // Get row of date id
    $dateRow = BookingDateTimes::find($aptID);
    Session::put('selection', $dateRow->booking_datetime);
    
    return View::make('customerInfo')->with('pid', Session::get('packageID'))->with('package_name', $package->package_name)->with('dateRow', $dateRow)->with('aptID', $aptID);
    
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
  public function anyConfirmed() {
    
    // When this boolean is set to True, instead of deleting all appointment times for the package duration
    // It will instead remove all times up to the end of the day, and continue to the next day until the package
    // time is done.
    $overlapDays = FALSE;
    $info = Session::get('appointmentInfo');
    $startTime = DateTime::createFromFormat('Y-m-d H:i', $info['datetime'] )->format('Y-m-d H:i');
    $endTime = new DateTime($info['datetime']);
    date_add($endTime, date_interval_create_from_date_string($info['package_time'].' hours'));
    $newCustomer = Customer::addCustomer();
    $endTime = $endTime->format('Y-m-d H:i');
    
    // Create the appointment with this new customer id
    Appointment::addAppointment($newCustomer);
    
    if ($overlapDays) {
      // Remove hours up to the last hour of the day, then continue to the next day
      // If necessary
      
      // PSEUDO CODE
      // We will get the last appointment of the day and see if it's smaller than the package time
      
      // If the last appointment occurs beyond the package duration, we delete like normal
      
      // If the last appointment occurs before the package duration
      // We subtract the hours we remove from the package duration to get remaining time
      // Then we go to the next day with appointment times and remove enough appointments
      // To make clearance for the package duration.
      
    } else {
      // Remove all dates conflicting with the appointment duration
      BookingDateTimes::timeBetween($startTime, $endTime)->delete();
    }
    
    return View::make('success');
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
  
    $availableTimes = DB::select('SELECT id, booking_datetime AS bdate, strftime("%H:%M", booking_datetime) AS bdatetime FROM booking_datetimes WHERE strftime("%Y-%m-%d", booking_datetime)="'.$selectedDay.'"');
    
    // PSEUDO CODE
    // Get package duration of the chosen package
    $package = Package::find(Session::get('packageID'));
    $packageTime = $package->package_time;
    
    // For each available time... 
    foreach($availableTimes as $t => $value):
   
    //get the start and end times of that time
    $startTime = new DateTime($value->bdate);
    $endTime = new DateTime($value->bdate);
    date_add($endTime, date_interval_create_from_date_string($packageTime.' hours')); 

    // Try to grab any appointments between the start time and end time
    $result = Appointment::timeBetween($startTime->format("Y-m-d H:i"), $endTime->format("Y-m-d H:i"));

    // If no records are returned, the time is okay, if not, we must remove it from the array
    if($result->first()) {
      unset($availableTimes[$t]);
    } 
   
    endforeach;

    return Response::make(View::make('getTimes')->with('selectedDay', $selectedDay)->with('availableTimes', $availableTimes), 200, array('Content-Type' =>     'application/json'));

  }
}