<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function county(){
		return $this->hasOne('App\Models\County', 'id' , 'county_id');
	}
	
	public function districts(){
		return $this->hasMany('App\Models\District' , 'ward_id', 'id');
	}
}
