@extends('layouts.customer')

@section('title')
Yoshiki x Rini
@endsection

@section('content')
@include('layouts.inc.IntroVideo')
<div class="p-3">
    <div class="container  d-flex align-items-center justify-content-around p-4 mt-5">
        <div class="border border-dark" style="width:20rem; background:#333;"></div> <!-- Dark Grey -->
        <h3 style="font-weight:bolder; padding:5px;">Top Categories</h3>
        <div class="border border-dark" style="width:20rem; background:#333;"></div> <!-- Dark Grey -->
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row w-100 ">
            @foreach ($category as $cate )
            <a href="{{url(asset('view-category/'.$cate->slug))}}" class="card col-md-4 " style="border:none;">
                <div class="card-body zoom zoomb position-relative">
                    <img src="{{ $cate->image_url }}" class="w-100 lazy rounded" height="200px" alt="">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <h4 style="letter-spacing:3px; background-color: white;" class="text-dark rounded">{{$cate->name}}</h4>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

<div class="container  d-flex align-items-center justify-content-around p-4">
    <div class="border border-dark" style="width:20rem; background:#333;"></div> <!-- Dark Grey -->
    <h3 style="font-weight:bolder; padding:5px;">NEW ARRIVALS</h3>
    <div class="border border-dark" style="width:20rem; background:#333;"></div> <!-- Dark Grey -->
</div>
<div class="py-5" id="products">
    <div class="container">
        <div class="row d-flex flex-wrap">
            @foreach ($product as $item )
            <div class="col-md-3 my-4">
                <a class="link-dark" href="{{url(asset('view-product/'.$item->slug))}}">
                    <div class="card hello-card" style="width: 18rem;">
                        <img src="{{ $item->image_url }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title">{{$item->name}}</h6>
                            @if ($item->original_price == $item->selling_price)
                            <span href="#" class=" pe-auto float-end">Rs. {{$item->selling_price}}</span>
                            @else
                            <span href="#" class=" pe-auto float-start"><s class="text-danger"> Rs.{{$item->original_price}}</s></span>
                            <span href="#" class=" pe-auto float-end">Rs. {{$item->selling_price}}</span>
                            @endif
                            <!-- Add to Cart and Buy Now Buttons -->
                        </div>
                        <div class="d-flex justify-content-center my-3 product_data">
                            <input type="hidden" value="{{ $item->id }}" class="prod_id">
                            <a href="{{url(asset('view-product/'.$item->slug))}}" class="btn btn-primary p-1 m-1">View Product<i class="fa fa-eye"></i></a>
                            <button class="btn btn-outline-primary p-1 m-1 float-start addToCartButton">Add to Cart<i class="fa-solid fa-cart-plus"></i></button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<section class="promo-banner bg-primary text-white py-5 text-center">
    <div class="container">
        <h2>Special Offer!</h2>
        <p>Get 20% off on all products.</p>
    </div>
</section>

<section class="testimonials py-5">
    <div class="container">
        <h2 class="text-center pb-5">What Our Customers Say</h2>
        <div class="row g-3 justify-content-center">
            <div class="col-md-4 testimonial-card">
                <div class="card p-3 shadow-sm border-0">
                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
                    <h5>- John Doe</h5>
                </div>
            </div>
            <div class="col-md-4 testimonial-card">
                <div class="card p-3 shadow-sm border-0">
                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
                    <h5>- Jane Smith</h5>
                </div>
            </div>
            <div class="col-md-4 testimonial-card">
                <div class="card p-3 shadow-sm border-0">
                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
                    <h5>- Sam Johnson</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="newsletter bg-light py-5 my-5 text-center">
    <div class="container">
        <h2>Subscribe to Our Newsletter</h2>
        <form action="{{ url('/newsletter') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Enter your email" aria-label="Email" aria-describedby="basic-addon2">
                <button type="submit" class="btn btn-primary input-group-text" id="basic-addon2">Subscribe</button>
            </div>
        </form>
    </div>
</section>
@endsection

@section('scripts')

<script>
    $(document).ready(function () {
        $(document).on('click', '.addToCartButton', function (e) {
            e.preventDefault();
            var product_id = $(this).closest('.product_data').find('.prod_id').val();
            var product_qty = 1;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method : "POST",
                url : "/add-to-cart",
                data : {
                    'product_id': product_id,
                    'product_qty': product_qty
                },
                success: function(response)
                {
                    if(response.status === "Please Login First...")
                    {

                        swal("Oops...", `${response.status}`, "error");
                    }
                    else if(response.status === "Please Verify you Email")
                    {

                        swal("Oops...", `${response.status}`, "error");
                    }
                    else
                    {
                        swal("Done!", `${response.status}`, "success");
                    }
                }
            })
        });
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- custom JS code after importing jquery and owl -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel();
    });

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        disable: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
</script>
@endsection

@section('css')
<style>
    .owl-nav {
        display: block !important;
    }

    .owl-nav button {
        font-size: 2rem !important;
    }
</style>
@endsection
