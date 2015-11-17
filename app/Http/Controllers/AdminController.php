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
    return view('admin/login')->with('errors', $errors);
  }
  
  /**
   * Function to attempt authorization, and redirect to admin page if successful, redirect to login with errors if not
   */
  public function anyLogin() {
    $input = Input::all();
    if (Auth::attempt(array('username' => $input['username'], 'password' => $input['password'] ))) {
      return redirect('admin/appointments');
    } else {
      $errors = "Invalid username or password";
      return view('admin/login')->with('errors', $errors);
    }
  }

  public function getAppointments() {
    return view('admin/appointments');
  }

  public function getAvailability() {
    return view('admin/availability');
  }

  public function getPackages() {
    return view('admin/packages');
  }
   
}