<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Response, View;
use Session;
use DB;
use DateTime;
use Nexmo;

// Declare Models to be used
use App\Models\Package;
use App\User;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\BookingDateTime;


class BookingController extends Controller
{

  /**
  * Function to retrieve the index page
  * User selects package to continue
  *
  **/
  public function getIndex() 
  {
   $packages = Package::all();
   return view('showPackages', ['packages' => $packages]);
 }

  /**
  * Function to retrieve datepicker
  *
  * User selects date + time to continue
  **/
  public function getCalendar()
  {

    //Add package to the session data
    // Session::put('packageID', $pid);
    // $package = Package::find($pid);
    
    // This groups all booking times by date so we can give a list of all days available.
    $data = [
  //  'packageName' => $package->package_name,
    'days' => BookingDateTime::all()
    ];
    
    return view('BookAppointment', $data);
  }
  
  /** 
  * Function to get customer details after Date & Time pick
  *
  **/
  public function getDetails($aptID)
  {

    // Put the passed date time ID into the session
    Session::put('aptID', $aptID);
   // $package = Package::find(Session::get('packageID'));
    
    // Get row of date id
    $dateRow = BookingDateTime::find($aptID);
    $dateFormat = new DateTime($dateRow->booking_datetime);
    $dateFormat = $dateFormat->format('g:i a \o\n l, jS \o\f F Y');
    Session::put('selection', $dateRow->booking_datetime);

    $data = [
    //'pid' => Session::get('packageID'),
    // 'package_name' => $package->package_name,
    'dateRow'   => $dateRow,
    'dateFormat' => $dateFormat,
    'aptID' =>  $aptID,
    ];

    return view('customerInfo', $data);
  }
  
  /**
  * Function to post customer info and present confirmation view
  * User Confirms appointment details to continue
  **/
  public function anyConfirm(Request $request) 
  {

    $this->validate($request, [
        'firstName' => 'required',
        'lastName' => 'required',
        'contactNumber' => 'required|numeric',
        'email' => 'required | email',
        'package' => 'required'
    ]);



    $input = Input::all();
    $package = Package::find($input['package']);

    $appointmentInfo = [ 
      "package_id"   => $input['package'],
      "package_name" => $package->package_name,
      "package_time" => $package->package_time,
      "datetime"     => Session::get('selection'),
      "fname"        => $input['firstName'],
      "lname"        => $input['lastName'],
      "number"       => $input['contactNumber'],
      "identity"     => $input['identityNumber'],
      "email"        => $input['email'],
      "updates"      => isset($input['newsletterBox']) ? 'Yes' : 'No'
      ];

    Session::put('appointmentInfo', $appointmentInfo);

    //Check if newsletterbox is checked, then add shit to database
    if(isset($input['newsletterBox'])) {
      Session::put('updates', '1');
    } else {
      Session::put('updates', '0');
    }

    $packageName = Package::where('id', $input['package'])->pluck('package_name');
    return View::make('confirm')->with('appointmentInfo', $appointmentInfo);
  }
  
  /**
   * Function to create the appointment, scrub the database, and send out an email confirmation
   *
   * User interaction is complete
   *
   **/
  public function anyConfirmed()
  {

    // When this boolean is set to True, instead of deleting all appointment times for the package duration
    // It will instead remove all times up to the end of the day, and continue to the next day until the package
    // time is done.
    $overlapDays = FALSE;
    $info = Session::get('appointmentInfo');
    $startTime = new DateTime($info['datetime']);
    $endTime = new DateTime($info['datetime']);
    date_add($endTime, date_interval_create_from_date_string($info['package_time'].' minutes'));
    $newCustomer = Customer::addCustomer();
    $startTime = $startTime->format('Y-m-d H:i');
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
      BookingDateTime::timeBetween($startTime, $endTime)->delete();
    }

    $message = 'Thanks for choosing us.';

      Nexmo::message()->send([
          'to' => '6'.$info['number'],
          'from' => 'Saimedic Clinic',
          'text' => 'Your appointment has been created with Saimedic Clinic at '.$startTime
      ]);
    
    return View::make('success');
  }
  
  /**
  * Function to retrieve times available for a given date
  *
  * View is returned in JSON format
  *
  **/
  public function getTimes()
  {

    // We get the data from AJAX for the day selected, then we get all available times for that day
    $selectedDay = Input::get('selectedDay');
    $availableTimes = DB::table('booking_datetimes')->get();

    // We will now create an array of all booking datetimes that belong to the selected day
    // WE WILL NOT filter this in the query because we want to maintain compatibility with every database (ideally)
    
    // PSEUDO CODE
    // Get package duration of the chosen package
    $package = Package::find(1);
    $packageTime = $package->package_time;
    
    // For each available time... 
    foreach($availableTimes as $t => $value) {

      $startTime = new DateTime($value->booking_datetime);
      if ($startTime->format("Y-m-d") == $selectedDay) {
        $endTime = new DateTime($value->booking_datetime);
        date_add($endTime, date_interval_create_from_date_string($packageTime.' minutes')); 

        // Try to grab any appointments between the start time and end time
        $result = Appointment::timeBetween($startTime->format("Y-m-d H:i"), $endTime->format("Y-m-d H:i"));

        // If no records are returned, the time is okay, if not, we must remove it from the array
        if($result->first()) {
          unset($availableTimes[$t]);
        } 

      } else {
        unset($availableTimes[$t]);
      }
    }   
    
    return response()->json($availableTimes);
  }
}
