@extends('layouts.customer')

@section('title')
    Payment
@endsection

@section('content')
<div class="py-5">

</div>

<div class="container mt-3">

    <div class="row">

        <div class="col-md-7">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h4>Select Payment Method</h4>
                </div>

                <div class="card-body">

                    <form action="{{ url('place-order') }}" method="POST">
                        @csrf

                        {{-- Pass checkout data as hidden inputs if needed --}}
                        <input type="hidden" name="fname" value="{{ $request->fname }}">
                        <input type="hidden" name="lname" value="{{ $request->lname }}">
                        <input type="hidden" name="email" value="{{ $request->email }}">
                        <input type="hidden" name="phoneno" value="{{ $request->phoneno }}">
                        <input type="hidden" name="address1" value="{{ $request->address1 }}">
                        <input type="hidden" name="address2" value="{{ $request->address2 }}">
                        <input type="hidden" name="city" value="{{ $request->city }}">
                        <input type="hidden" name="state" value="{{ $request->state }}">
                        <input type="hidden" name="country" value="{{ $request->country }}">
                        <input type="hidden" name="pincode" value="{{ $request->pincode }}">

                        <div class="form-check mb-3">
                            <input class="form-check-input"
                                   type="radio"
                                   name="payment_mode"
                                   value="cod"
                                   checked>

                            <label class="form-check-label">
                                Cash on Delivery (COD)
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input"
                                   type="radio"
                                   name="payment_mode"
                                   value="razorpay">

                            <label class="form-check-label">
                                Razorpay
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input"
                                   type="radio"
                                   name="payment_mode"
                                   value="stripe">

                            <label class="form-check-label">
                                Stripe
                            </label>
                        </div>

                        <button class="btn btn-primary mt-3">
                            Continue
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <div class="col-md-5">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>

                <div class="card-body">

                    <table class="table">

                        <thead>

                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>

                        </thead>

                        <tbody>

                        @php
                            $total = 0;
                        @endphp

                        @foreach($cartitem as $item)

                            <tr>

                                <td>{{ $item->products->name }}</td>

                                <td>{{ $item->prod_qty }}</td>

                                <td>
                                    ₹{{ $item->products->selling_price }}
                                </td>

                            </tr>

                            @php
                                $total += $item->products->selling_price * $item->prod_qty;
                            @endphp

                        @endforeach

                        </tbody>

                    </table>

                    <hr>

                    <h5 class="text-end">
                        Total : ₹{{ $total }}
                    </h5>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="py-5">

</div>

@endsection