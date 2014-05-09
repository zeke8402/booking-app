<?php

class BookingDatesTableSeeder extends Seeder {
  
  public function run()
  {
    
    Eloquent::unguard();
    
    // DB::table('packages')->delete();
    $currentDate = date('Y-m-d');
    BookingDates::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 5 days')),
      'date_type' => '1'
    ));
    
    BookingDates::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 10 days')),
      'date_type' => '1'
    ));
    
    // Set a whole week
     BookingDates::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 11 days')),
      'date_type' => '1'
    ));
    
     BookingDates::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 12 days')),
      'date_type' => '1'
    ));
    
     BookingDates::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 13 days')),
      'date_type' => '1'
    ));
    
     BookingDates::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 14 days')),
      'date_type' => '1'
    ));
    
     BookingDates::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 15 days')),
      'date_type' => '1'
    ));
    
     BookingDates::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 16 days')),
      'date_type' => '1'
    ));
    
     BookingDates::create(array(
      'booking_date' => date('Y-m-d', strtotime($currentDate. ' + 17 days')),
      'date_type' => '1'
    ));
  }
}
