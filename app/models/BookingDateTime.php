<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class BookingDateTime extends Model implements AuthenticatableContract {

  use Authenticatable;

  protected $table = 'booking_datetimes';
  
  public function scopeTimeBetween($query, $begin, $end) {
    return $query->where('booking_datetime', '>=', $begin)->where('booking_datetime', '<', $end);
  }
 
}
