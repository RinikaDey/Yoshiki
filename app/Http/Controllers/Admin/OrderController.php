<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::where('status', 0)
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('tracking_no', 'LIKE', "%{$search}%")
              ->orWhere('fname', 'LIKE', "%{$search}%")
              ->orWhere('lname', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('phoneno', 'LIKE', "%{$search}%")
              ->orWhere('payment_status','LIKE',"%{$search}%")
              ->orWhere('payment_mode','LIKE',"%{$search}%")
              ->orWhere('address1', 'LIKE', "%{$search}%");
            });
        })
        ->get();
        return view('Admin.orders.index' , compact('order'));
    }
    public function view($id)
    {
        $order = Order::where('id',$id)->first();
        return view('Admin.orders.view' , compact('order'));
    }

    public function updateOrder(Request $request , $id)
    {
        $order = Order::find($id);
        $order->status = $request->input('order_status');
        $order->payment_status = $request->input('payment_status');
        $order->update();
        return redirect('orders')->with('status','Order Status Updated Successfully');
    }
    public function orderHistory(Request $request)
    {
         $order = Order::whereIn('status', [1, 2])
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('tracking_no', 'LIKE', "%{$search}%")
                  ->orWhere('fname', 'LIKE', "%{$search}%")
                  ->orWhere('lname', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('payment_mode','LIKE',"%{$search}%")
                  ->orWhere('phoneno', 'LIKE', "%{$search}%");
            });
        })
        ->get();
        return view('Admin.orders.completedOrders' , compact('order'));
    }
}