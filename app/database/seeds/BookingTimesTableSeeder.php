<?php

class BookingTimesTableSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    // DB::table('packages')->delete();
    $currentDate = date('Y-m-d');
    BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 5 days')),
      'booking_time' => '01:00'
    ));
    
    BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 5 days')),
      'booking_time' => '23:00'
    ));
    
    BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 10 days')),
      'booking_time' => '13:00'
    ));
    
    BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 10 days')),
      'booking_time' => '14:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 11 days')),
      'booking_time' => '13:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 11 days')),
      'booking_time' => '16:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 12 days')),
      'booking_time' => '10:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 12 days')),
      'booking_time' => '14:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 13 days')),
      'booking_time' => '16:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 13 days')),
      'booking_time' => '17:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 14 days')),
      'booking_time' => '13:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 14 days')),
      'booking_time' => '11:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 15 days')),
      'booking_time' => '12:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 15 days')),
      'booking_time' => '13:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 16 days')),
      'booking_time' => '16:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 16 days')),
      'booking_time' => '19:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 17 days')),
      'booking_time' => '13:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 17 days')),
      'booking_time' => '14:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 17 days')),
      'booking_time' => '15:00'
    ));
    
     BookingTimes::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 17 days')),
      'booking_time' => '16:00'
    ));
  }
}
