@extends('layouts.customer')
@section('title', $product->name)

@section('content')
    <div class="py-5"></div>
    <div class="bg-light border rounded p-3 mb-3 shadow-sm w-75 d-flex mx-auto">
        <h6 class="mb-0">
            <a href="{{ url('category') }}">Collection</a>/
            <a href="{{ url('view-category/' . $product->category->slug) }}">{{ $product->category->name }}</a>/
            <a href="{{ url('view-category/' . $product->category->slug . '/' . $product->slug) }}">{{ $product->name }}</a>
        </h6>
    </div>
    <div class="container py-5">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right my-auto mx-auto">
                        <img src="{{ $product->image_url }}" alt="" class="w-100">
                    </div>
                    <div class="col-md-8 my-auto mx-auto">
                        <h1 class="mb-0">
                            {{ $product->name }}
                            <label for="" style="font-size: 1rem; background:rgba(234,88,11,255); color:white;" class="float-end badge trending_tag">{{ $product->trending == "1" ? 'Trending' : '' }}</label>
                        </h1>
                        <hr>
                        <label for="" class="me-3">MRP  : <s class="text-danger">Rs {{ $product->original_price }}</s></label>
                        <label for="" class="fw-bold">Offer Price  : Rs {{ $product->selling_price }}</label>
                        <p class="mt-3 py-3">
                            {!! $product->small_description !!}
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam labore quibusdam voluptate repudiandae accusamus dicta aut voluptates doloremque perspiciatis beatae!
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente incidunt ducimus culpa vita
                        </p>
                        <hr>
                        @if ($product->qty > 0)
                            <label for="" style="background:rgba(234,88,11,255); color:white;" class="badge">In Stock</label>
                        @else
                            <label for="" class="badge bg-danger">Out Of Stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-sm-4 col-md-4 col-xl-2">
                                <input type="hidden" value="{{ $product->id }}" class="prod_id">
                                <label for="quantity" class="py-3">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" readonly name="quantity" value="1" class="form-control quantity-input bg-light text-center p-1">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-8 col-xl-10">
                                <br/>
                                <br/>
                                @if ($product->qty > 0)
                                <button class="btn btn-outline-primary me-3 float-start addToCartButton py-3 w-100">Add to Cart <i class="fa-solid fa-cart-plus"></i></button>
                                @endif
                                @if ($product->qty == 0)
                                    <p class="text-danger py-3 w-100">Out of Stock</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- You May Also Like Section -->
    <div class="py-5">
        <h2 class="text-center py-5 my-5">You May Also Like</h2>
        <div class="container">
            <div class="row py-3" id="related-products">
                <!-- Related products will be loaded here via AJAX -->
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script>
    $(document).ready(function () {
        $('.addToCartButton').click(function(e){
            e.preventDefault();
            var product_id = $(this).closest('.product_data').find('.prod_id').val();
            var product_qty = $(this).closest('.product_data').find('.quantity-input').val();
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
        })

        $('.increment-btn').click(function (e) {
            e.preventDefault();

            var inc_value = $('.quantity-input').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value < 10)
            {
                value++;
                $('.quantity-input').val(value);
            }
        })
        $('.decrement-btn').click(function (e) {
            e.preventDefault();
            console.log('hello')

            var inc_value = $('.quantity-input').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value > 1)
            {
                value--;
                $('.quantity-input').val(value);
            }
        })

        // Fetch related products
        $.ajax({
            method: "GET",
            url: "/related-products/{{ $product->id }}",
            success: function(response) {
                console.log(response)
                var relatedProducts = response.related_products;
                var html = '';
                relatedProducts.forEach(function(product) {
                    const categorySlug = "{{ $product->category->slug }}";
                    html += `
                        <div class="col-md-3 mb-4 d-flex justify-content-center">
                            <div class="card shadow product_data text-center w-100 my-auto">
                            <a href="/view-category/${categorySlug}/${product.slug}">
                                <div class="card-body zoom">
                                    <img src="http://localhost:8000/upload/product/${product.image}" alt="" class="w-100">
                                    <h5 class="mt-2">${product.name}</h5>
                                    <p><s class="text-danger">MRP : Rs ${product.original_price}</s> </p>
                                    <p><b>Offer Price : Rs ${product.selling_price} </b></p>
                                </div>
                            </a>
                            </div>
                        </div>
                    `;
                });
                $('#related-products').html(html);
            }
        });
    })
</script>
@endsection
