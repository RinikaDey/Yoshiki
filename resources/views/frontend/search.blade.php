@extends('layouts.customer')
@section('title')
Search Page
@endsection

@section('content')
<div class="py-5"></div>

<div class="d-flex justify-content-center">
    <div class="bg-light border rounded p-3 shadow-sm w-75 text-center">
        <h6 class="mb-0">
            <a href="{{ url('/category') }}" class="text-decoration-none">Search result for : <b>{{$search}}</b></a>
        </h6>
    </div>
    <div class="d-flex justify-content-center">
        <button id="list-view" class="btn btn-secondary mx-2">List</button>
        <button id="grid-view" class="btn btn-secondary">Grid</button>
    </div>
</div>

<div class="py-3 my-3">
    <div class="container">
        <div class="row list-view-container d-none text-light">
            @foreach ($products as $prod )
                <div class="col-md-12 mb-3">
                    <a class="link-dark" href="{{ url('view-category/'.$prod->category->slug.'/'.$prod->slug) }}">
                        <div class="card card-list-view d-flex flex-row align-items-center">
                            <div class="card-body flex-grow-1 px-5">
                                <h4>{{ $prod->name }}</h4>
                                <span class="float-start px-3 text-decoration-line-through text-danger"><s class="text-danger"> Rs.{{ $prod->original_price }}</s></span>
                                <span class="float-start px-3 text-bold fw-bolder">Rs. {{ $prod->selling_price }}</span>
                                <span class="float-start px-3 text-dark">{{ $prod->small_description }}</span>
                            </div>
                            <img src="{{ $prod->image_url }}" alt="no-image" class="card-img-top">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row grid-view-container">
            @foreach ($products as $prod )
                <div class="col-md-3 mb-3">
                    <a class="link-dark" href="{{ url('view-category/'.$prod->category->slug.'/'.$prod->slug) }}">
                        <div class="card">
                            <img src="{{ $prod->image_url }}" alt="no-image" class="card-img-top">
                            <div class="card-body">
                                <h5>{{ $prod->name }}</h5>
                                <span class="float-start">Rs. {{ $prod->selling_price }}</span>
                                <span class="float-end"><s class="text-danger"> Rs.{{ $prod->original_price }}</s></span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const listViewButton = document.getElementById('list-view');
    const gridViewButton = document.getElementById('grid-view');
    const listViewContainer = document.querySelector('.list-view-container');
    const gridViewContainer = document.querySelector('.grid-view-container');

    listViewButton.addEventListener('click', function() {
        listViewContainer.classList.remove('d-none');
        gridViewContainer.classList.add('d-none');
        listViewButton.classList.add('btn-primary');
        listViewButton.classList.remove('btn-secondary');
        gridViewButton.classList.add('btn-secondary');
        gridViewButton.classList.remove('btn-primary');
    });

    gridViewButton.addEventListener('click', function() {
        listViewContainer.classList.add('d-none');
        gridViewContainer.classList.remove('d-none');
        gridViewButton.classList.add('btn-primary');
        gridViewButton.classList.remove('btn-secondary');
        listViewButton.classList.add('btn-secondary');
        listViewButton.classList.remove('btn-primary');
    });
});
</script>
@endsection

<style>
/* Custom styles for toggle buttons */
#list-view, #grid-view {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    border-radius: 0.25rem;
    transition: background-color 0.3s ease, color 0.3s ease;
}

#list-view:hover, #grid-view:hover {
    opacity: 0.8;
}

/* Custom styles for product cards */
.card {
    border-radius: 0.5rem;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Custom styles for list view cards */
.card-list-view {
    align-items: center; /* Align items vertically in the flex container */
}

.card-list-view .card-body {
    flex-grow: 1; /* Allow text content to grow and fill available space */
    padding-right: 0; /* Remove default padding on the right side */
}

.card-list-view .card-img-top {
    max-width: 200px; /* Set a maximum width for the image */
    height: auto; /* Maintain aspect ratio */
    margin-left: 1rem; /* Add some spacing between text and image */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .grid-view-container .col-md-3 {
        flex-basis: 100%;
    }
}

@media (min-width: 769px) and (max-width: 992px) {
    .grid-view-container .col-md-3 {
        flex-basis: 50%;
    }
}
</style>
