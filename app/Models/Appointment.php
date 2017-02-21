<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Session;


class Appointment extends Model implements AuthenticatableContract{

    use authenticatable;

  	protected $table = 'appointments';
    protected $fillable = array('customer_id', 'appointment_type', 'appointment_datetime','service_type');
    protected $guarded = array('id', 'created_at', 'updated_at');

    /**
     * Customer relation 
     * Appointment has one customer
     */
    public function customer()
    {
      return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }
  
    public static function addAppointment($customerID) {
      $info = Session::get('appointmentInfo');
      Appointment::create(array(
        'customer_id'  => $customerID,
        'appointment_type'  =>  $info['package_id'],
        'appointment_datetime'  =>  $info['datetime'],
        'service_type'  =>  $info['service_type']
      ));
    }

    public function scopeTimeBetween($query, $begin, $end) {
      //return $query->whereBetween('appointment_datetime', array($begin, $end));
      return $query->where('appointment_datetime', '>', $begin)->where('appointment_datetime', '<', $end);
    } 
}
