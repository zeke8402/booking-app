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

	/**
	 * Sets availability based on POST data
	 * @param $start [Start datetime of selection]
	 * @param $end   [End datetime of selection]
	 *
	 * @return  response()->json() - description of events
	 */
	public function SetAvailability()
	{
		$post = Input::all();
		$configs = Configuration::with('timeInterval')->first();

		// Creating our datetime variables
		$startDate = new \DateTime($post['start']);
		$intervalDate = new \DateTime($post['start']);
		$endDate = new \DateTime($post['end']);

		// This loops from start to end, creating availability based on
		// configuration interval variables between start and end
		while($intervalDate < $endDate) {
			$intervalDateEnd = new \DateTime($intervalDate->format('Y-m-d H:i:s'));
			$intervalDateEnd->add(new \DateInterval('PT'.$configs->timeInterval->interval.'M'));

			// We check to make sure we are not overlapping existing availability
			if (BookingDateTime::timeBetween($intervalDate, $intervalDateEnd)->first()) {
				return response()->json("Segment overlaps with existing availability", 500);
			} else {
				BookingDateTime::addAvailability($intervalDate);
				$intervalDate->add(new \DateInterval('PT'.$configs->timeInterval->interval.'M'));
			}
		}

		return response()->json('success', 200);
	}
}
