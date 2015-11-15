<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

// Model Usage
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\BookingDateTime;
use App\Models\Package;

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

			$package = Package::find($a['appointment_type']);

			$startDate = date_create($a['appointment_datetime']);
			$endDate = date_create($a['appointment_datetime']);
			$time = (string)$package->package_time.' hours';
			$endDate = date_add($endDate, date_interval_create_from_date_string($time));
			$event = array(
				'id' => '999',
				'title' => 'Appointment with '.$customer,
				'start' => $startDate->format('Y-m-d\TH:i:s'),
				'end' => $endDate->format('Y-m-d\TH:i:s'),
			);
			array_push($calendarAppointments, $event);
		}

		return response()->json($calendarAppointments);
	}

}
