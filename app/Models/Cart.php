<?php

namespace App\Models;
use Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id','user_id','order_id','ip_address','product_quantity',
    ];


    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function ProductImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }



    public static function totalCarts(){

        if (Auth::check()){
            $carts = Cart::Where('user_id', Auth::id())
                    ->orWhere('ip_address', request()->ip())
                    ->where('order_id', NULL)
                    ->get();
        }
        else{
            $carts = Cart::where('ip_address', request()->ip())
            ->where('order_id', NULL)
            ->get();
        }


        $total_item = 0;
        foreach($carts as $cart){
            $total_item += $cart->product_quantity;
        }

        return $total_item;
    
    }

    

}
