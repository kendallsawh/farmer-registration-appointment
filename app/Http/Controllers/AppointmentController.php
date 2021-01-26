<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\District;
use App\Models\Ward;
use App\Models\County;
use App\Models\Gender;
use App\Models\AddressLotType;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use DB;

class AppointmentController extends Controller
{
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  public function index()
    {
      /*$available_dates = DB::table('appointments')
              ->selectRaw('count(appointment_date) as count, appointment_date')
              ->where('county_id',2)
              ->where(DB::raw('"count"'),'<',5)
              ->whereDate('appointment_date', '>', Carbon::now() )
              ->orderBy('appointment_date','asc')
              ->groupBy('appointment_date')
              ->get();
              return $available_dates;*/
        
      $data = array(
                    'genders' => Gender::all(),
                    'districts' => District::all(),
                    'lot_types' => AddressLotType::all(),
                    'title' => 'Farmer Registration Appointment Form',
                    
                );
        return view('appointments.appointment',$data);
        //return view('portal',$data);
    }
  public function ajaxGetAppointment(Request $request)
    {

    	try {
    	$from = date('2018-01-01');
		$to = date('2018-05-02');
		$ward = Ward::find(District::find($request->districtid)->ward_id);
    	$county = County::find($ward->county_id)->id;
      //return $county;

    	

    	$available_dates = DB::table('appointments')
  						->selectRaw('count(appointment_date) as count, appointment_date')
  						->where('county_id',$county)
  						->where(DB::raw('"count"'),'<',5)
  						->whereDate('appointment_date', '>', Carbon::now() )
  						->orderBy('appointment_date','asc')
  						->groupBy('appointment_date')
  						->get();
  						//->pluck('count', 'appointment_date');
  		
  		

  		$html = '';
  		if (count($available_dates)==0) {
  			$last_date = Appointment::selectRaw('appointment_date')
                                ->where('county_id',$county)
                                ->whereDate('appointment_date', '>', Carbon::now() )
                                ->orderBy('appointment_date','desc')
                                ->first();
        if($last_date){
          //code to get next day
          
          for ($i=1; $i < 4; $i++) { 
              $date = Carbon::parse($last_date->appointment_date)->addDays($i)->toDateString();
              $html = $html.'<input type="radio" id="appoint_date-'.$i.'" name="appointment_date" value="'.$date.'" class=""><label for="appoint_date-"'.$i.' class=""> Date option '.$i.': '.$date.'. Available space left: '.(5).'</label><hr><br>';
          }

        }
        else{
          for ($i=1; $i < 4; $i++) {
              $date = Carbon::today()->addDays($i)->toDateString();
              $html = $html.'<input type="radio" id="appoint_date-'.$i.'" name="appointment_date" value="'.$date.'" class=""><label for="appoint_date-'.$i.'" class=""> Date option '.$i.': '.$date.'. Available space left: '.(5).'</label><hr><br>';
            }
          }
            
  		}
  		elseif (count($available_dates)==1) {
  			

  			/*$last_date = Appointment::selectRaw('appointment_date')
                                ->where('county_id',$county)
                                ->whereDate('appointment_date', '>', Carbon::now() )
                                ->orderBy('appointment_date','desc')
                                ->first();
            for ($i=1; $i < 4; $i++) { 
            	$date = Carbon::parse($last_date->appointment_date)->addDays($i)->toDateString();
            	$html = $html.'<input type="radio" id="appoint_date-'.$i.'" name="appointment_date" value="'.$date.'"><label for="appoint_date-'.$i.'"> Date option '.$i.': '.$date.'. Available space left: '.(5).'</label><hr><br>';
            }*/
            $increment = 1;
            foreach ($available_dates as $date) {
              $html = $html.'<input type="radio" id="appoint_date-'.$increment.'" name="appointment_date" value="'.$date->appointment_date.'"><label for="appoint_date-'.$increment.'"> Date option '.$increment.': '.$date->appointment_date.'. Available space left: '.(5-$date->count).'</label><hr><br>';
              $increment ++;    
            }
            for ($i=2; $i <4 ; $i++) { 
              $html = $html.'<input type="radio" id="appoint_date-'.$i.'" name="appointment_date" value="'.Carbon::parse($available_dates->last()->appointment_date)->addDays($i-1)->toDateString().'"><label for="appoint_date'.$i.'"> Date option '.$i.': '.Carbon::parse($available_dates->last()->appointment_date)->addDays($i-1)->toDateString().' Available space left: 5</label><hr><br>';
            }
            

  		}
  		elseif (count($available_dates)==2) {
  			
        //select the latest date for the county    
  			/*$last_date = Appointment::selectRaw('appointment_date')
                                ->where('county_id',$county)
                                ->whereDate('appointment_date', '>', Carbon::now() )
                                ->orderBy('appointment_date','desc')
                                ->first();
            for ($i=1; $i < 4; $i++) { 
            	$date = Carbon::parse($last_date->appointment_date)->addDays($i)->toDateString();
            	$html = $html.'<input type="radio" id="appoint_date-'.$i.'" name="appointment_date" value="'.$date.'"><label for="appoint_date-'.$i.'"> Date option '.$i.': '.$date.'. Available space left: '.(5).'</label><hr><br>';
            }*/
            $increment = 1;
            foreach ($available_dates as $date) {
              $html = $html.'<input type="radio" id="appoint_date-'.$increment.'" name="appointment_date" value="'.$date->appointment_date.'"><label for="appoint_date-'.$increment.'"> Date option '.$increment.': '.$date->appointment_date.'. Available space left: '.(5-$date->count).'</label><hr><br>';
              $increment ++;    
            }
            $html = $html.'<input type="radio" id="appoint_date-3" name="appointment_date" value="'.Carbon::parse($available_dates->last()->appointment_date)->addDays(1)->toDateString().'"><label for="appoint_date-3"> Date option 3: '.Carbon::parse($available_dates->last()->appointment_date)->addDays(1)->toDateString().' Available space left: 5</label><hr><br>';
  		}
  		elseif (count($available_dates)==3) {
  			$increment = 1;
  			foreach ($available_dates as $date) {
  				$html = $html.'<input type="radio" id="appoint_date-'.$increment.'" name="appointment_date" value="'.$date->appointment_date.'"><label for="appoint_date-'.$increment.'"> Date option '.$increment.': '.$date->appointment_date.'. Available space left: '.(5-$date->count).'</label><hr><br>';
  				$increment ++;		
  			}
  		}
  		
  		
    		
    		return $html;
    		
            
        } catch (Exception $e) {
            //return errors if fail
            return \Response::json(['status' => 500, 'message' => $e->getMessage()],442);
        }
    }
}
