<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Auth;

// Model Usage
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\BookingDateTime;
use App\Models\Package;
use App\Models\Configuration;

class AdminAPIController extends Controller
{

	public function __construct() 
	{
		$this->middleware('auth');
	}

	/**
	 * Retrieves all appointments and returns them
	 * in fullCalendar expected JSON
	 */
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
				'id' => $a['id'],
				'title' => 'Appointment with '.$customer,
				'start' => $startDate->format('Y-m-d\TH:i:s'),
				'end' => $endDate->format('Y-m-d\TH:i:s'),
			);
			array_push($calendarAppointments, $event);
		}

		return response()->json($calendarAppointments);
	}

	public function GetAppointmentInfo($id)
	{
		$appointment = Appointment::with('customer')->find($id);
		return response()->json($appointment);
	}

	public function GetAllAvailability()
	{
		$times = BookingDateTime::all();
		$availability = array();
		$configs = Configuration::with('timeInterval')->first();
		foreach($times as $t) {
			$startDate = date_create($t['booking_datetime']);
			$endDate = date_create($t['booking_datetime']);

			// Get configuration variable
			// @todo default metric is minutes and only one supported
			// change to whichever metrics we support in the future
			$timeToAdd = $configs->timeInterval->interval; //minutes
			$endDate = $endDate->add(new \DateInterval('PT'.$timeToAdd.'M'));
			$event = [
				'id' => $t['id'],
				'title' => 'Available',
				'start' => $startDate->format('Y-m-d\TH:i:s'),
				'end' => $endDate->format('Y-m-d\TH:i:s'),
				'overlap' => false,
				'rendering' => 'background',
			];
			array_push($availability, $event);
		}
		return response()->json($availability);	
	}

	public function SetAvailability()
	{
		// WARNING
		// @todo: availability allows overlaps. DO NOT ALLOW THIS
		// We need to detect if the event overlaps another in it's time frame
		$post = Input::all();
		$configs = Configuration::with('timeInterval')->first();

		$startDate = new \DateTime($post['start']);
		$intervalDate = new \DateTime($post['start']);
		$endDate = new \DateTime($post['end']);

		// PSEUDO CODE
		// Create first interval (timeInterval) minutes after start date
		// While intervalDate is less than endDate...
		// Add (timeInterval) minutes and store to db
		while($intervalDate < $endDate) {
			BookingDateTime::addAvailability($intervalDate);
			$intervalDate->add(new \DateInterval('PT'.$configs->timeInterval->interval.'M'));
		}

		return response()->json('success', 200);
	}
}
