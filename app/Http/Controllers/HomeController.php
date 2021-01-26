<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\AddressLotType;
use Carbon\Carbon;
use App\Models\Gender;
use App\Models\Appointment;
use App\Models\County;
use DB;
class HomeController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
    	$data = array(
                    'genders' => Gender::all(),
                    'districts' => District::all(),
                    'lot_types' => AddressLotType::all(),
                    'title' => 'Farmer Registration Appointment Form',
                    
                );
        //return view('appointments.appointment',$data);
        return view('portal',$data);
    }
}
