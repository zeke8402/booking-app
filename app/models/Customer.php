<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Session;
use Validator;

class Customer extends Model implements AuthenticatableContract{

  use Authenticatable;
  protected $table = 'customers';
  protected $fillable = array('first_name', 'last_name', 'contact_number', 'email', 'wants_updates');
  protected $guarded = array('id', 'created_at', 'updated_at');
  
  /**
   * Function to add a new customer to the database
   *
   * Returns customer id for appointment creation
   *
   **/
  public static function addCustomer() {
    
    // We get appointment information then set up our validator
    $info = Session::get('appointmentInfo');
    $validator = Validator::make(
      array(
        'first_name'  =>  $info['fname'],
        'last_name'   =>  $info['lname'],
        'email'       =>  $info['email']
      ),
      array(
        'first_name'  =>  'exists:customers,first_name',
        'last_name'   =>  'exists:customers,last_name',
        'email'       =>  'exists:customers,email'
      )
    );
    
    // If the validator fails, that means the user does not exist
    // If any of those three variables don't exist, we create a new user
    // This is so that families can use the same e-mail to book, but
    // We stil create a new user for them in the database.
    if ($validator->fails()) {
      // Registering the new user
      return Customer::create(array(
        'first_name'  =>  $info['fname'],
        'last_name'   =>  $info['lname'],
        'contact_number' => $info['number'],
        'email'       =>  $info['email'],
        'wants_updates' => Session::get('updates')
        ))->id;
    } else {
      return Customer::where('email', $info['email'])->pluck('id');
    }
    
  }
  
  
}
