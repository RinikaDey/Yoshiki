@extends('layouts.customer')
@section('title')
    {{$category->name}}
@endsection

@section('content')
<div class="py-5">
</div>

<div class="container">
    <div class="row">
        <!-- Sidebar for Sorting and Filtering -->
        <div class="col-md-3">
            <div class="bg-light border rounded p-3 mb-3 shadow-sm">
                <h6 class="mb-0">Sort & Filter</h6>
                <form action="{{ url('view-category/' . $category->slug) }}" method="GET" id="sortFilterForm">
                    <!-- Sorting Dropdown -->
                    <div class="mb-3">
                        <label for="sortBy" class="form-label">Sort By:</label>
                        <select name="sortBy" id="sortBy" onchange="document.getElementById('sortFilterForm').submit();" class="form-select">
                            <option value="none" {{ request()->input('sortBy') == 'none' || !request()->has('sortBy') ? 'selected' : '' }}>None</option>
                            <option value="name_asc" {{ request()->input('sortBy') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request()->input('sortBy') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            <option value="price_asc" {{ request()->input('sortBy') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                            <option value="price_desc" {{ request()->input('sortBy') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                        </select>
                    </div>

                    <!-- Filtering Checkboxes -->
                    <div class="mb-3">
                        <label for="filter" class="form-label">Filter By:</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ request()->input('status') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="trending" id="trending" value="1" {{ request()->input('popular') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="trending">Trending</label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9">
            <div class="bg-light border rounded p-3 mb-3 shadow-sm">
                <h6 class="mb-0">
                    <a href="{{url('category')}}" class="text-decoration-none">Collections</a>/
                    <span class="fw-bold">{{$category->name}}</span>
                </h6>
            </div>

            <div class="py-3 my-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mb-4">{{$category->name}}</h2>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3">
                            @foreach ($product as $prod )
                                <div class="col p-3 mx-auto my-auto">
                                    <a class="link-dark text-decoration-none" href="{{url(asset('view-category/'.$category->slug.'/'.$prod->slug))}}">
                                        <div class="card h-100 shadow-sm zoom">
                                            <img src={{ $prod->image_url }} alt="no-image" class="card-img-top img-fluid">
                                            <div class="card-body p-3">
                                                <h5 class="card-title mb-2">{{$prod->name}}</h5>
                                                <p class="card-text text-decoration-line-through text-danger small">MRP : Rs. {{ $prod->original_price }}</p>
                                                <p class="card-text text-muted small"><b>Offer Price : Rs. {{ $prod->selling_price }}</b></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection