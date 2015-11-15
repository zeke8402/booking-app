<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookingDateTime;

class BookingDateTimeTableSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    // DB::table('packages')->delete();
    $currentDate = date('Y-m-d');
    BookingDateTime::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 5 days + 5 hours'))
    ));
    
    BookingDateTime::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 10 days + 16 hours'))
    ));
    
    // Set a whole week
     BookingDateTime::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 8 hours'))
    ));
    
      // Set a whole week
     BookingDateTime::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 9 hours'))
    ));
    
      // Set a whole week
     BookingDateTime::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 10 hours'))
    ));
    
      // Set a whole week
     BookingDateTime::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 11 hours'))
    ));
    
      // Set a whole week
     BookingDateTime::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 12 hours'))
    ));
    
      // Set a whole week
     BookingDateTime::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 13 hours'))
    ));
    
     BookingDateTime::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 12 days + 8 hours'))
    ));
    

  }
}
