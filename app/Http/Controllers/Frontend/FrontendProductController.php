<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function index(Request $request){
        $product = Product::with(['category','productImageGallery','brand','productVariant','vendor'])->where('status', 1)->where('slug', $request->slug)->first();
        return view('frontend.pages.product-details', compact(['product']));
    }
}