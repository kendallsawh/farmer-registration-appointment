<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class County extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = false;
    public function wards(){
    	return $this->hasMany('App\Models\Ward' , 'county_id', 'id');
    }
}
