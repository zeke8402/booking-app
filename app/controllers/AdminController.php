<?php
class AdminController extends BaseController {
  
  
  public function getIndex() {
    $errors = "None";
    return View::make('admin/adminLogin')->with('errors', $errors);
  }
  
  public function anyLogin() {
    $input = Input::all();
    if (Auth::attempt(array('username' => $input['username'], 'password' => $input['password'] ))) {
      return View::make('admin/success');
    } else {
      $errors = "Invalid username or password";
      return View::make('admin/adminLogin')->with('errors', $errors);
    }
    
  }
  
  public function getTest() {
    return View::make('admin/success');
  }
}