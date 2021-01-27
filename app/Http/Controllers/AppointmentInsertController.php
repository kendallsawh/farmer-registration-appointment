<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Appointment;
use App\Models\Individual;
use App\Models\IndividualAddress;
use App\Models\IndividualContact;
use App\Models\Contact;
use App\Models\District;
use App\Models\County;
use DB;
use Notification;
use App\Models\TestGroup;
use App\Notifications\AppointmentNotification;
use App\Notifications\NotifiyApplicant;

class AppointmentInsertController extends Controller
{
    public function insert(Request $request){
    	//dd($request->all());
       DB::beginTransaction();//BEGIN THE PROCESS //
        try {
            $appointment = new Appointment;
            $address = new Address;
            $individual = new Individual;
            $indi_add = new IndividualAddress;
            $indi_cont = new IndividualContact;
            $contact = new Contact;

            $individual->f_name = $request->firstname;
            $individual->l_name =$request->lastname;
            $individual->gender_slug =$request->gender;
            $individual->email =$request->email;
            $individual->save();

            $address->lot_type_id = $request->lot_type;
            $address->house_num = $request->house_no;
            $address->road = $request->road;
            $address->district_id = $request->district;
            $address->save();

            $indi_add->ind_id = $individual->id;
            $indi_add->add_id = $address->id;
            $indi_add->save();

            $contact->contact = $request->mobilenumber;
            $contact->contact_type_id = 1;
            $contact->save();

            $indi_cont->individual_id = $individual->id;
            $indi_cont->contact_id = $contact->id;
            $indi_cont->save();
            
            $appointment->appointment_date = $request->appointment_date;
            $appointment->individual_id = $individual->id;
            $appointment->county_id =  District::find($request->district)->ward()->first()->county_id;
            $appointment->comments = $request->comments;
            $appointment->appointment_type = $request->options;
            $appointment->save();

            $users = TestGroup::find($appointment->county_id);

            foreach ($users as $user) {
                
                Notification::send($user, new AppointmentNotification($appointment,$user));
            }

            $county = County::find($appointment->county_id);
            $regtype = $appointment->appointment_type == 1? 'New' : 'Renewal';
            Notification::route('mail', $individual->email)
                            ->notify(
                                new NotifiyApplicant(
                                    $individual->name,$appointment->appointment_date,$county,$regtype)
                                
                            );
               
                   
               

            DB::commit();
            return view('appointments.success');
        } catch (Exception $e) {
            DB::rollBack();
            return back();
        }
    	
    }
}
