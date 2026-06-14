@extends('layouts.customer')

@section('title')
Maintenance Mode
@endsection

@section('content')
<!-- Maintenance Section -->
<div class="py-5 my-5"></div>
<section class="maintenance py-5 my-5">
    <div class="container text-center">
        <h1 class="display-4 mb-4">We're currently under maintenance</h1>
        <p class="lead mb-4">Sorry for the inconvenience. We are working hard to get everything back up and running as soon as possible.</p>
        <!-- Optional: Add a countdown timer or loading spinner -->
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</section>
<div class="py-5 my-5"></div>
@endsection