<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Payment;
use Auth;
use DB;

class PaymentController extends Controller
{
    

    public function index() {

        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::id())
                    ->where('ip_address', request()->ip())
                    ->get();
        }
        else {
            $carts = Cart::where('ip_address', request()->ip())->get();
        }

        $payments = Payment::orderBy('priority', 'asc')->get();
        return view('pages.products.payments', compact('carts', 'payments'));
    }


    public function store(Request $request) {

        $validated = $request->validate([
            'receiver_name' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'shipping_address' => 'required',
            'payment_method' => 'required',
        ]);

        $order = new Order;

        // transaction id given or not
        if($request->payment_method != 'cash_in'){
            if($request->transaction_id == NULL || empty($request->transaction_id)){
                $notify = array('messege' => 'Please put your transaction id', 'alert-type' => 'info');
                return redirect()->route('payment.index')->with($notify);
            }
            else{
                $order->transaction_id = $request->transaction_id;
            }
        }

        $payment_method_id = Payment::where('short_name', $request->payment_method)->first()->id;

        if(Auth::check()){
            $order->user_id = Auth::id();
        }
        
        $order->payment_id = $payment_method_id;
        $order->ip_address = request()->ip();
        $order->name = $request->receiver_name;
        $order->phone_no = $request->phone_no;
        $order->shipping_address = $request->shipping_address;
        $order->email = $request->email;
        $order->message = $request->message;
        $order->save();

        $cart = Cart::where('user_id', $order->user_id)->first();
        if($cart != NULL){
            $cart->order_id = $order->id;
            $cart->save();
        }

        $notify = array('messege' => 'Your order has taken. Please wait admin will confirm it!!', 'alert-type' => 'success');
        return redirect()->route('index')->with($notify);

    }



}
