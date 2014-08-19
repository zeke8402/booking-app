<?php
class AdminController extends BaseController {
  
  
  public function getIndex() {
    $errors = "None";
    return View::make('admin/adminLogin')->with('errors', $errors);
  }
  
  public function anyLogin() {
    $input = Input::all();
    if (Auth::attempt(array('username' => $input['username'], 'password' => $input['password'] ))) {
      return $this->getAdminPage();
    } else {
      $errors = "Invalid username or password";
      return View::make('admin/adminLogin')->with('errors', $errors);
    }
    
  }
  
  public function getAdminPage() {
    return View::make('admin/main');
  }
}