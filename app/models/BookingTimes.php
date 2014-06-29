<?php

class BookingTimes extends Eloquent{
  	protected $table = 'booking_times';
  
    public function scopeDate($query, $date) {
      return $query->where('booking_date', $date);
    }
  
    public function scopeBetween($query, $begin, $end) {
      return $query->whereBetween('booking_time', array($begin, $end));
    }
}