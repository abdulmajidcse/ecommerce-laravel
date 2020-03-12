<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //fillable array
    protected $fillable = [
    	'name', 'priority',
    ];
}
