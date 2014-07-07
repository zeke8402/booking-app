<?php

class BookingDateTimes extends Eloquent{
  	protected $table = 'booking_datetimes';
  
    public function scopeDate($query, $date) {
      return $query->where('strftime("%Y-%m-%d", booking_date)', $date);
    }
  
    /*
    public function scopeBetween($query, $begin, $end) {
     // return $query->whereBetween('booking_time', array($begin, $end));
      return $query->where('booking_time', '>=', $begin)->where('booking_time', '<', $end);
    } */
}