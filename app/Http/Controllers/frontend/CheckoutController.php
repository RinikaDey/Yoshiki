<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitem=Cart::where('user_id',Auth::id())->get();
        foreach($old_cartitem as $item)
        {
            if(!Product::where('id',$item->prod_id)->where('qty' , '>=' , $item->prod_qty)->exists())
            {
                $removeItem = Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
                $removeItem->delete();
            }
        }
        $cartitem=Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout' , compact('cartitem'));
    }

    public function placeOrder(Request $request)
    {
        // Validate input data (assuming validation rules are already defined in the controller or request class)
        $validatedData = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'phoneno' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'pincode' => 'required|string',
        ]);

        // Create a new order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $validatedData['fname'];
        $order->lname = $validatedData['lname'];
        $order->email = $validatedData['email'];
        $order->phoneno = $validatedData['phoneno'];
        $order->address1 = $validatedData['address1'];
        $order->address2 = $validatedData['address2'] ?? '';
        $order->city = $validatedData['city'];
        $order->state = $validatedData['state'];
        $order->country = $validatedData['country'];
        $order->pincode = $validatedData['pincode'];
        $order->payment_mode = $request->input('payment_mode');

        if ($request->payment_mode == "cod") {

            $order->payment_status = "Pending";

        } else {

            $order->payment_status = "Paid";

        }

        // Calculate total price
        $totalPrice = 0;
        $cartItems = Cart::where('user_id', Auth::id())->get();

        foreach ($cartItems as $item) {
            $totalPrice += $item->products->selling_price * $item->prod_qty;
        }

        $order->total_price = $totalPrice;
        $order->tracking_no = 'Rini' . rand(1111, 9999);
        $order->save();

        // Create order items and update product quantities
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price,
            ]);

            $prod  = Product::where('id' , $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->save();
        }

        // Update user address if it's not already set
        $user = Auth::user();
        if (!$user->address1) {
            $user->phoneno = $validatedData['phoneno'];
            $user->address1 = $validatedData['address1'];
            $user->address2 = $validatedData['address2'] ?? '';
            $user->city = $validatedData['city'];
            $user->state = $validatedData['state'];
            $user->country = $validatedData['country'];
            $user->pincode = $validatedData['pincode'];
            $user->save();
        }
        $cartitem = Cart::where('user_id',Auth::id())->get();
        foreach ($cartitem as $cart) {
            $cart->delete();
        }


        return redirect('/')->with('status', "Order Placed successfully");
    }

    public function payment(Request $request)
    {
        $cartitem = Cart::where('user_id', auth()->id())->get();

        return view('frontend.payment', [
            'request' => $request,
            'cartitem' => $cartitem,
        ]);
    }
}
