<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;

use Input;
use Auth;
use View;
class AdminController extends Controller {
  
  /**
   * Function to retrieve the index page
   */
  public function getIndex() {
    $errors = "None";
    //return View::make('admin/adminLogin')->with('errors', $errors);
    return view('admin/login')->with('errors', $errors);
  }
  
  /**
   * Function to attempt authorization, and redirect to admin page if successful, redirect to login with errors if not
   */
  public function anyLogin() {
    $input = Input::all();
    if (Auth::attempt(array('username' => $input['username'], 'password' => $input['password'] ))) {
      return $this->getAdminPage();
    } else {
      $errors = "Invalid username or password";
      return view('admin/login')->with('errors', $errors);
    }
    
  }
  
  /**
   * Function to load main admin view page when successfully logging in
   */
  public function getAdminPage() {
    return view('admin/calendar');
  }
  
  public function getAppointments() {
    
    $appointments = Appointment::all();
    $calendarAppointments = array();
    foreach($appointments as $a) {
      $customer = Customer::find($a['customer_id']);
      $customer = $customer->first_name.' '.$customer->last_name;
      $event = array(
        'title' => 'Appointment with '.$customer,
        'start' => $a['appointment_datetime']
        );
      array_push($calendarAppointments, $event);
    }
    
    return response()->json($calendarAppointments);
  }
}
