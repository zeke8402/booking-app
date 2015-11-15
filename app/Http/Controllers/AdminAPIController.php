<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

// Model Usage
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\BookingDateTime;

class AdminAPIController extends Controller
{

	public function __construct() 
	{
		$this->middleware('auth');
	}

	public function GetAllAppointments()
	{
		$appointments = Appointment::all();
		$calendarAppointments = array();
		foreach($appointments as $a) {
			$customer = Customer::find($a['customer_id']);
			$customer = $customer->first_name.' '.$customer->last_name;
			$event = array(
				'title' => 'Appointment with '.$customer,
				'start' => $a['appointment_datetime']
				);
			array_push($calendarAppointments, $event);
		}

		return response()->json($calendarAppointments);
	}

}
