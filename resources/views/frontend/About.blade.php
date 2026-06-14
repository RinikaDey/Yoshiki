@extends('layouts.customer')


@section('title')
Yoshiki x Rini
@endsection


@section('content')
<section class="about py-5 my-5">
    <div class="container py-3 my-3">
        <h1 class="text-center mb-4">About Us</h1>
        <p class="lead text-center">Welcome to Premium ECommerce, your trusted online store for the latest fashion and technology.</p>
        <p class="pb-3">We are dedicated to providing our customers with high-quality products and excellent customer service. Our mission is to make shopping easy, convenient, and enjoyable.</p>
        <h2 class="py-3">Our Team</h2>
        <div class="row">
            <!-- Team Member 1 -->
            <div class="col-md-4 mb-4">
                <img src="https://placehold.co/200x200/png" alt="John Doe" class="rounded-circle img-fluid mx-auto d-block mb-3">
                <h4>John Doe</h4>
                <p>CEO &amp; Founder</p>
                <p>With over 20 years of experience in the technology industry, John has led Premium ECommerce to become a trusted online store.</p>
            </div>

            <!-- Team Member 2 -->
            <div class="col-md-4 mb-4">
                <img src="https://placehold.co/200x200/png" alt="Jane Smith" class="rounded-circle img-fluid mx-auto d-block mb-3">
                <h4>Jane Smith</h4>
                <p>Head of Marketing</p>
                <p>Jane has a proven track record in digital marketing and helps drive the brand's growth through innovative strategies.</p>
            </div>

            <!-- Team Member 3 -->
            <div class="col-md-4 mb-4">
                <img src="https://placehold.co/200x200/png" alt="Michael Brown" class="rounded-circle img-fluid mx-auto d-block mb-3">
                <h4>Michael Brown</h4>
                <p>Customer Service Manager</p>
                <p>Michael ensures that our customers have a positive experience and are satisfied with their purchases.</p>
            </div>
        </div>
    </div>
</section>
@endsection