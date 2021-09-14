<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

use PDF;

class OrderController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $orders = Order::orderBy('id','desc')->get();
        return view('admin.pages.order.index')->with('orders', $orders);
    }

    public function show($id) {
        $order = Order::find($id);
        $order->is_seen_by_admin = 1;
        $order->save();
        return view('admin.pages.order.show', compact('order'));
    }


    public function destroy($id){
        $order = Order::find($id);
        if(!is_null($order)){
            //$order->delete();
        }

        $notify = array('messege' => 'Your Order Delete Successfully', 'alert-type' => 'success');
        return back()->with($notify);
    }

    public function complete($id) {
        $order = Order::find($id);

        if($order->is_completed){
            $order->is_completed = 0;
        }
        else{
            $order->is_completed = 1;
        }
        $order->save();

        $notify = array('messege' => 'Order Completed Successfully!!', 'alert-type' => 'success');
        return back()->with($notify);
    }

    public function paid($id) {
        $order = Order::find($id);

        if($order->is_paid){
            $order->is_paid = 0;
        }
        else{
            $order->is_paid = 1;
        }
        $order->save();

        $notify = array('messege' => 'Order Paid Successfully!!', 'alert-type' => 'success');
        return back()->with($notify);
    }

    public function chargeUpdate(Request $request, $id) {
        $order = Order::find($id);

        $order->shipping_cost = $request->shipping_cost;
        $order->custom_discount = $request->custom_discount;
        $order->save();

        $notify = array('messege' => 'Order Shipping Charge and Discount has Updated!!', 'alert-type' => 'success');
        return back()->with($notify);
    }

    public function generateInvoice($id) {
        $order = Order::find($id);

        $pdf = PDF::loadView('admin.pages.order.invoice', compact('order'));

        return view('admin.pages.order.invoice', compact('order'));
        //$pdf->download('invoice.pdf');
        //return $pdf->stream('invoice.pdf');
    }

}
