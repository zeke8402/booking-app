<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

// Model Usage
use App\Models\BookingDateTime;

class APIController extends Controller
{

    // Get available days
    function GetAvailableDays() {
        return response()->json(BookingDateTime::all());
    }
  
}
