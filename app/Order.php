<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'user_id',
        'payment_id',
    	'ip_address',
    	'name',
    	'phone',
    	'shipping_address',
    	'email',
    	'message',
        'transaction_id',
        'offer',
    	'is_paid',
    	'is_completed',
    	'is_seen_by_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}
