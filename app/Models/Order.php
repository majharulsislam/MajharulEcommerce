<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'payment_id', 'ip_address','name','phone_no','shipping_address','email','message', 'shipping_cost', 'custom_discount','is_paid','is_completed','is_seen_by_admin','transaction_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
