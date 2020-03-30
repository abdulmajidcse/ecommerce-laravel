<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialContact extends Model
{
    protected $fillable = [
    	'social_url',
    	'icon',
    	'priority',
    ];
}
