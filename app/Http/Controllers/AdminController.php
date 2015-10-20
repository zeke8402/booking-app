<?php
namespace App\Http\Controllers;

use Input;
use Auth;
class AdminController extends Controller {
  
  /**
   * Function to retrieve the index page
   */
  public function getIndex() {
    $errors = "None";
    //return View::make('admin/adminLogin')->with('errors', $errors);
    return view('admin/adminLogin')->with('errors', $errors);
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
      return view('admin/adminLogin')->with('errors', $errors);
    }
    
  }
  
  /**
   * Function to load main admin view page when successfully logging in
   */
  public function getAdminPage() {
    return view('admin/main');
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
    
    return View::make('admin/appointments')->with('appointments', $calendarAppointments);
  }
}
