<?php

class Appointment extends Eloquent{
  	protected $table = 'appointments';
  /*
    public function scopeDate($query, $date) {
      return $query->where('appointment_date', $date);
    }
  
    public function scopeBetween($query, $begin, $end) {
      return $query->whereBetween('appointment_time', array($begin, $end));
    } */
}