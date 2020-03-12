<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	//fillable array
	protected $fillable = [
		'admin_id', 'category_id', 'brand_id', 'title', 'description', 'slug', 'quantity', 'price', 'status', 'offer_price'
	];

    public function productImages(){
    	return $this->hasMany('App\ProductImage', 'product_id');
    }

    public function categories(){
    	return $this->belongsTo(Category::class, 'category_id');
    }

    public function brands(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
