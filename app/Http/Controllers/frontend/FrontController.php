<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontController extends Controller
{
    public function mainpage()
    {
        $category = category::where('popular','1')->take(6)->get();
        $product = Product::where('trending','1')->take(12)->get();
        return view('frontend.index' , compact('category', 'product'));
    }
    public function category(Request $request)
    {
//        dd($request->all());
//        $category = Category::where('status','0')->get();
//        return view('frontend.category' , compact('category'));

        $query = Category::query();

        // Sorting
        if ($request->has('sortBy') && $request->input('sortBy') !== 'none') {
            switch ($request->input('sortBy')) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                // Add other sorting cases as needed
            }
        }

        // Filtering
        if ($request->has('status') && $request->input('status') == '1') {
            $query->where('status', 1);
        }

        if ($request->has('popular') && $request->input('popular') == '1') {
            $query->where('popular', 1);
        }

        $category = $query->get();

        return view('frontend.category', compact('category'));
    }

    public function viewCategory($slug, Request $request)
    {
        // Find the category by slug
        $category = Category::where('slug', $slug)->first();

        if (!$category & $request==null) {
            abort(404); // Return 404 if category not found
        }

        $query = Product::where('cate_id', $category->id);
                    
        // Sorting
        if ($request->has('sortBy') && $request->input('sortBy') !== 'none') {
            switch ($request->input('sortBy')) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderByRaw('CAST(selling_price AS UNSIGNED) asc');
                    break;
                case 'price_desc':
                    $query->orderByRaw('CAST(selling_price AS UNSIGNED) desc');
                    break;
            }
        }

        // Filtering
        if ($request->has('status') && $request->input('status') == '1') {
            $query->where('status', 1);
        }

        if ($request->has('trending') && $request->input('trending') == '1') {
            $query->where('trending', 1);
        }

        $product = $query->get();

        return view('frontend.products.index', compact('category', 'product'));
    }

    public function productView($cate_slug  ,$prod_slug )
    {
        if(Category::where('slug',$cate_slug)->exists())
        {
            if(Product::where('slug',$prod_slug)->exists())
            {
                $product = Product::where('slug',$prod_slug)->first();
                return view('frontend.products.view', compact('product'));
            }
            else
            {
                return redirect('/')->with('status',"No Such Product Found");
            }
        }
        else
        {
            return redirect('/')->with('status',"No such Category found");
        }
    }
    public function eachProdView($prod_slug)
    {


            if(Product::where('slug',$prod_slug)->exists())
            {
                $product = Product::where('slug',$prod_slug)->first();
                return view('frontend.products.view', compact('product'));
            }
            else
            {
                return redirect('/')->with('status',"No Such Product Found");
            }
    }
    public function searchProducts(Request $request)
    {   
        $search = $request->product_name;

        // Find categories matching the search
        $categoryIds = Category::where('name', 'LIKE', "%{$search}%")
                    ->pluck('id','slug');

        // Find products by name or category
        $products = Product::with('category')
                ->where(function ($query) use ($search, $categoryIds) {

                    $query->where('name', 'LIKE', "%{$search}%")
                          ->orWhere('description', 'LIKE', "%{$search}%")
                          ->orWhereIn('cate_id', $categoryIds);

                })
                ->get();

        return view('frontend.search', compact('products', 'search'));

    }

    public function getRelatedProducts($productId)
    {
        \DB::enableQueryLog(); // Enable query log

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['related_products' => []], 404); // Return 404 Not Found if product is not found
        }

        // Fetch related products based on category or other attributes
        $relatedProducts = Product::where('cate_id', $product->cate_id)
            ->where('id', '!=', $productId) // Ensure the current product is excluded
            ->inRandomOrder() // Randomize the results
            ->take(4) // Limit to 4 related products
            ->get();

        \Log::info(\DB::getQueryLog()); // Log the executed queries

        return response()->json (['related_products' => $relatedProducts]);
    }
}

