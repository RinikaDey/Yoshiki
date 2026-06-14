@extends('layouts.customer')
@section('title')
My Orders
@endsection

@section('content')
<div class="py-5"></div>
<div class="container ">
    <a href="{{url('/my-order')}}" class="btn btn-outline-info mb-3">Back</a>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-head">
                    <h4 class="my-2">My Orders</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="my-1">First Name</label>
                            <div class="border p-2 ">{{$order->fname}}</div>
                            <label for="" class="my-1">Last Name</label>
                            <div class="border p-2">{{$order->lname}}</div>
                            <label for="" class="my-1">Email</label>
                            <div class="border p-2">{{$order->email}}</div>
                            <label for="" class="my-1">Contact No</label>
                            <div class="border p-2">{{$order->phoneno}}</div>
                            <label for="" class="my-1">Shipping Address</label>
                            <div class="border p-2">
                                {{$order->address1}}
                                <br>
                                {{$order->address2}}
                                <br>
                                {{$order->city}}
                                <br>
                                {{$order->state}}
                                <br>
                                {{$order->country}}
                                <br>
                            </div>
                            <label class="my-1" for="">ZIP CODE</label>
                            <div class="border p-2">{{$order->pincode}}</div>

                        </div>
                        <div class="col-md-6 table-responsive">
                            <table class="table  align-middle text-center ">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td> {{$item->products->name}} </td>
                                        <td> {{$item->qty}} </td>
                                        <td> {{$item->price}} </td>
                                        <td>
                                            <img style="width: 100px ; height:100px;" src="{{ $item->products->image_url }}" alt="">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2">Grand Total : <span class="float-end">Rs. {{ $order->total_price }}</span></h4>
                        </div>
                    </div>

                </div>
                <!-- Add the Cancel Order button -->
                @if ($order->status == '0')
                <form action="{{ route('order.cancel', ['id' => $order->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-outline-danger mt-3 w-100 p-3">Cancel Order</button>
                </form>
                @endif
                @if ($order->status == '2')
                    <button type="submit" class="btn btn-dark mt-3 w-100 p-3 disabled">Order Cancelled</button>
                @endif
                @if ($order->status == '1')
                    <button type="submit" class="btn btn-info mt-3 w-100 p-3 disabled">Order Completed</button>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="py-3"></div>

@endsection
