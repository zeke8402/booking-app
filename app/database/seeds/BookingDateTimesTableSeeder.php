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
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 11 days'))
    ));
    
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 12 days'))
    ));
    
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 13 days'))
    ));
    
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 14 days'))
    ));
    
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 15 days'))
    ));
    
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 16 days'))
    ));
    
     BookingDateTimes::create(array(
      'booking_datetime' => date('Y-m-d H:i', strtotime($currentDate. ' + 17 days'))
    ));
  }
}
