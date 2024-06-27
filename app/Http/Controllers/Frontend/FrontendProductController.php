<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function index(Request $request){
        $product = Product::with(['category','productImageGallery','brand','productVariant','vendor'])->where('status', 1)->where('slug', $request->slug)->first();
        return view('frontend.pages.product-details', compact(['product']));
    }

    public function products(Request $request){
        if($request->has('category')){
            $category = Category::where('slug', $request->category)->first();
            $products = Product::where(['status' => 1, 'is_approved' => 1, 'category_id' => $category->id])->paginate(12);
        }
        return view('frontend.pages.products', compact('products'));
    }
}
