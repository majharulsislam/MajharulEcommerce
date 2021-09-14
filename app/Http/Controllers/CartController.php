<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Auth;
use DB;

class CartController extends Controller
{

    public function index()
    {
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

        return view('pages.products.carts',compact('carts'));
    }


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
            }

            $cart->product_id = $request->product_id;
            $cart->ip_address = request()->ip();
            $cart->save();
        }

        $notify = array('messege' => 'Your Product Added Successfully!!', 'alert-type' => 'success');

        return back()->with($notify);

    }


    public function update(Request $request, $id) {
        $cart = Cart::find($id);
        if(!is_null($cart)){
            $cart->product_quantity = $request->product_quantity;
            $cart->save();

            $notify = array('messege' => 'Cart updated successfully!!', 'alert-type' => 'success');
            return back()->with($notify);
        }
        else{
            return back();
        }
    }

    public function destroy($id) {
        $cart = Cart::find($id);

        if(!is_null($cart)){
            $cart->delete();

            $notify = array('messege' => 'Cart remove successfully!!', 'alert-type' => 'info');
            return back()->with($notify);
        }
        else{
            return back();
        }
    }





}
