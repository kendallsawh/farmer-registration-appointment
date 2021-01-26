<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class District extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];
	public function ward(){
		return $this->hasOne('App\Models\Ward', 'id' , 'ward_id')->get();
	}
}
