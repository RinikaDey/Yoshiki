<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use APP\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id',Auth::id())->get();
        return view('frontend.orders.index', compact('orders'));
    }

    public function viewOrder($id)
    {
        $order = Order::where('id' , $id)->where('user_id',Auth::id())->first();
        return view('frontend.orders.view', compact('order'));
    }

    public function cancelOrder(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Check if the order can be cancelled (e.g., status is not already cancelled)
        if ($order->status === 'Cancelled') {
            return redirect()->back()->with('error', 'Order has already been cancelled.');
        }
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        foreach ($orderItems as $item) {

            $product = Product::find($item->prod_id);

            if ($product) {
                $product->qty += $item->qty;
                $product->save();
            }
        }
        // Update the order status to 'Cancelled'
        $order->status = '2';
        if($order->payment_mode == 'cod'){
            $order->payment_status = 'Pending';
        }
        else{
            $order->payment_status = 'Refund';
        }
        $order->save();

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }

    public function userDetails() 
    {
        return view('frontend.myAccount');   
    }

    public function updateUser(Request $request)
    {
        if(Auth::check())
        {
            $user = User::where('id',Auth::id())->first();
            $user->name = $request->input('name');
            $user->phoneno = $request->input('phoneno');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
            return redirect('/');
        }
    }
   
}
