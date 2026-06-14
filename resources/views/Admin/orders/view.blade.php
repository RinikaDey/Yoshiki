@extends('layouts.admin')


@section('content')
<div class="container ">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-head">
                    <a href="{{url('orders')}}" class="btn btn-primary my-1">Back</a>
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
                                        <th>Qunatity</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr >
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
                            <div class="mt-3">
                                <form action="{{url('update-order/'.$order->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if($order->status == 2)

                                        <label for="">Order Status</label>

                                        <select class="form-select p-2" disabled>
                                            <option selected>Cancelled</option>
                                        </select>

                                        <input type="hidden" name="order_status" value="2">

                                    @else
                                        <label for="">Order Status</label>

                                        <select name="order_status" class="form-select p-2">
                                            <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>

                                    @endif
                                    <label for="">Payment Status</label>
                                    <select name="payment_status" class="form-select p-2" >
                                        <option {{$order->payment_status == 'Pending' ? 'selected' : ''}} value="Pending">Pending</option>
                                        <option {{$order->payment_status == 'Paid' ? 'selected' : ''}} value="Paid">Paid</option>
                                        <option {{$order->payment_status == 'Refund' ? 'selected' : ''}} value="Refund">Refund</option>
                                    </select>
                                    <button type="submit" class="btn btn-info my-2 w-100"> Update </button>
                                </form>
                            </div>
                         </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>




@endsection
{{--
<form action="{{url('update-order/'.$order->id)}}" method="POST">
    @csrf
    @method('PUT')
    <select name="order_status" class="form-select" id="">
        <option {{$order->status == '0' ? 'selected' : ''}} value="0">Pending</option>
        <option {{$order->status == '1' ? 'selected' : ''}} value="0">Completed</option>
    </select>
    <button type="submit" class="btn btn-outline-info my-2 w-100"> Update </button>
</form> --}}
