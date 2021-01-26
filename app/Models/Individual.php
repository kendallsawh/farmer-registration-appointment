<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function getNameAttribute()
    {
    	return ucwords($this->attributes['f_name'].' '.$this->attributes['l_name']);
       /* if ($this->attributes['m_name']) 
	        return ucwords($this->attributes['f_name'].' '.$this->attributes['m_name'].' '.$this->attributes['l_name']);
	    else
	    	return ucwords($this->attributes['f_name'].' '.$this->attributes['l_name']);*/
    }

    public function getAddressAttribute(){
		//return $this->home();
		return App\Models\Address::where('id',$this->add_id())->first()->address;
	}

    public function home(){
		return App\Models\Address::whereIn('id', DB::table('addresses')
					->join('individual_addresses','individual_addresses.add_id','=','addresses.id')
					->join('individuals','individuals.id','=','individual_addresses.ind_id')
					->join('address_lot_types','address_lot_types.id','=','addresses.lot_type_id')
					->join('districts','districts.id','=','addresses.district_id')
					->where('individuals.id',$this->id)
					->whereIn('individual_addresses.ind_add_type_id',[1,3])
					->pluck('addresses.id')
				)->first();
	}

	public function add_id(){
		return $this->hasOne('App\Models\IndividualAddress', 'ind_id' , 'id')->first()->add_id;
	}

}
