<?php

class Appointment extends Eloquent{
  	protected $table = 'appointments';
    protected $fillable = array('customer_id', 'appointment_type', 'appointment_datetime');
    protected $guarded = array('id', 'created_at', 'updated_at');
  
    public static function addAppointment($customerID) {
      $info = Session::get('appointmentInfo');
      Appointment::create(array(
        'customer_id'  => $customerID,
        'appointment_type'  =>  $info['package_id'],
        'appointment_datetime'  =>  $info['datetime']
      ));
    }
  /*
    public function scopeDate($query, $date) {
      return $query->where('appointment_date', $date);
    }
  */
    public function scopeTimeBetween($query, $begin, $end) {
      //return $query->whereBetween('appointment_datetime', array($begin, $end));
      return $query->where('appointment_datetime', '>', $begin)->where('appointment_datetime', '<', $end);
    } 
}