<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    protected $fillable = [
    	'product_id',
    	'user_id',
    	'order_id',
    	'ip_address',
    	'product_quantity',
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public static function totalCart()
    {
        $cart = Cart::orWhere('user_id', Auth::id())
                ->where('ip_address', Request()->ip())
                ->where('order_id', NULL)
                ->get();
        return $cart;

    }

    public static function totalItems()
    {
        $cart = Cart::orWhere('user_id', Auth::id())
                ->where('ip_address', Request()->ip())
                ->where('order_id', NULL)
                ->sum('product_quantity');
        return $cart;

    }
}
