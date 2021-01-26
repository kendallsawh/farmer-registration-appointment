<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Individual;
class Appointment extends Model
{
    use HasFactory,SoftDeletes;
    public function getIndividualAttribute($value)
    {
    	$individual = Individual::where('id',$this->individual_id)->first();
		 
			return $individual;
		
    }
}
