<?php

class BookingController extends BaseController {
  
  public function showIndex()
	{
	  $packages = Package::all();
    return View::make('package_select')->with('packages', $packages);
	}

  public function showCalendar()
  {
    return View::make('day_select'); 
  }

  
}