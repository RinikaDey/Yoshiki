@extends('layouts.customer')
@section('title')
    Category
@endsection

@section('content')
<div class="py-5 my-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar for Sorting and Filtering -->
            <div class="col-md-3">
                <div class="bg-light border rounded p-3 mb-3 shadow-sm">
                    <h6 class="mb-0">Sort & Filter</h6>
                    <form action="{{ url('category') }}" method="GET" id="sortFilterForm">
                        <!-- Sorting Dropdown -->
                        <div class="mb-3">
                            <label for="sortBy" class="form-label">Sort By:</label>
                            <select name="sortBy" id="sortBy" onchange="document.getElementById('sortFilterForm').submit();" class="form-select">
                                <option value="none" {{ request()->input('sortBy') == 'none' || !request()->has('sortBy') ? 'selected' : '' }}>None</option>
                                <option value="name_asc" {{ request()->input('sortBy') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                                <option value="name_desc" {{ request()->input('sortBy') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            </select>
                        </div>

                        <!-- Filtering Checkboxes -->
                        <div class="mb-3">
                            <label for="filter" class="form-label">Filter By:</label>
                            </br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ request()->input('status') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Moonsoon</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="popular" id="popular" value="1" {{ request()->input('popular') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="popular">Popular</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </form>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-9 pb-3">
                <div class="bg-light border rounded p-3 mb-3 shadow-sm">
                    <h6 class="mb-0">
                        <a href="http://localhost:8000/category" class="text-decoration-none">Collections</a>/
                    </h6>
                </div>
                <div class="col-md-12 p-3">
                    <h2 class="mb-4">All Categories</h2>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
                    @foreach ($category as $cate)
                        <div class="col mx-auto my-auto m-3 p-3">
                            <a href="{{ url(asset('view-category/' . $cate->slug)) }}">
                                <div class="card h-100 border-0 shadow-sm card-zoom">
                                    <img src="{{ $cate->image_url }}" alt="{{ $cate->name }}" class="card-img-top img-fluid rounded">
                                    <div class="card-body p-3 text-center zoom">
                                        <h5 class="card-title mb-2">{{ $cate->name }}</h5>
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

@endsection

<style>
.card-zoom:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

.card-body.zoom.position-relative.d-flex.align-items-center.justify-content-center {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 200px;
    /* Ensure the card body has a fixed height */
}
.text-light.text-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
</style>
