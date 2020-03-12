<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * fillable field are here
     */
    protected $fillable = [
    	'name', 'description', 'image', 'parent_id'
    ];

    public function parent(){
    	return $this->belongsTo(Category::class, 'parent_id');
    }
}
