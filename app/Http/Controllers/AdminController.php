<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Package;
use App\Models\Customer;
use App\Models\Configuration;
use App\Models\TimeInterval;

use Illuminate\Support\Facades\Input;
use Auth;
use View;
use Nexmo;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use DateTime;

class AdminController extends Controller {
  
  /**
   * Function to retrieve the index page
   */
  public function __construct() 
  {
    $this->middleware('auth');
  }
  
  public function index()
  {
    $errors = "None";
    return view('admin/appointments')->with('errors', $errors);
  }

  public function appointments()
  {
    return view('admin/appointments');
  }

  public function availability()
  {
    return view('admin/availability');
  }

  public function configuration()
  {
    $configuration = Configuration::with('timeInterval')->first();
    return view('admin/configuration', ['configuration' => $configuration]);
  }

  /**
   * View function for list of packages
   * @return view 
   */
  public function packages() {
    $packages = Package::all();
    return view('admin/packages/index', ['packages' => $packages]);
  }

  /**
   * View Function to edit package information
   * @param  int $package_id
   * @return view
   */
  public function editPackage($package_id)
  {
    return view('admin/packages/editPackage', ['package' => Package::find($package_id)]);
  }

  public function updatePackage($package_id)
  {
    dd('tets');
  }

  public function anySetTime()
  {
    dd('test');
  }

  public function sendsms(Request $request){

    $input = Input::all();

    try{
      Nexmo::message()->send([
           'to' => '6'.$input['number'],
           'from' => 'Saimedic Clinic',
           'text' => 'Updates from Saimedic Clinic : '.$input['text']
     ]);
    }
    catch (Exception $e) {

    } 
    finally{
      return redirect()->back(); 
    }

  }

}