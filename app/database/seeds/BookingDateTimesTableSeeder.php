<?php

class BookingDateTimesTableSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    // DB::table('packages')->delete();
    $currentDate = date('Y-m-d');
    BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 5 days + 5 hours'))
    ));
    
    BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 10 days + 16 hours'))
    ));
    
    // Set a whole week
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 8 hours'))
    ));
    
      // Set a whole week
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 9 hours'))
    ));
    
      // Set a whole week
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 10 hours'))
    ));
    
      // Set a whole week
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 11 hours'))
    ));
    
      // Set a whole week
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 12 hours'))
    ));
    
      // Set a whole week
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days + 13 hours'))
    ));
    
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 12 days + 8 hours'))
    ));
    

  }
}
