<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //fillable array
    protected $fillable = [
    	'division_id', 'name',
    ];

    //many to one relationship from district table to division
    public function division(){
    	return $this->belongsTo('App\Division', 'division_id');
    }
}
