<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Auth;
use DB;

class CartController extends Controller
{


    public function create(){
        $products = Product::orderBy('id', 'asc')->get();
        return view('pages.products.partials.cart-button',compact('products'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'product_id' => 'required'
        ],
        [
            'product_id.required' => 'Please give a product'
        ]);

        if(Auth::check()){
            $cart = Cart::Where('user_id', Auth::id())
            ->Where('product_id', $request->product_id)
            ->Where('order_id', NULL)
            ->first();
        }
        else{
            $cart = Cart::Where('ip_address', request()->ip())
            ->Where('product_id', $request->product_id)
            ->Where('order_id', NULL)
            ->first();
        }
        

        if(!is_null($cart)){
            $cart->increment('product_quantity');
        }
        else {
            $cart = new Cart;

            if (Auth::check()){
                $cart->user_id = Auth::id();
                $cart->product_id = $request->product_id;
                $cart->ip_address = request()->ip();
                $cart->save();
            }

            else{
                $cart->product_id = $request->product_id;
                $cart->ip_address = request()->ip();
                $cart->save();
            }
        }

        return json_encode(['status' => 'success', 'message' => 'Your Product Carted Successfully!', 'totalitems' => Cart::totalCarts()]);

    }



}
