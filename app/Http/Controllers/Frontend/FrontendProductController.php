<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendProductController extends Controller
{
    public function index(Request $request){
        $product = Product::with(['category','productImageGallery','brand','productVariant','vendor'])->where('status', 1)->where('slug', $request->slug)->first();
        return view('frontend.pages.product-details', compact(['product']));
    }

    public function products(Request $request){
        if($request->has('category')){
            $category = Category::where('slug', $request->category)->firstOrFail();
            $products = Product::where(['status' => 1, 'is_approved' => 1, 'category_id' => $category->id])
            ->when($request->has('range'), function($query) use ($request){
                $price = explode(';', $request->range);
                return $query->where('price', '>=', $price[0])->where('price', '<=', $price[1]);
            })
            ->paginate(12);
        }elseif($request->has('subCategory')){
            $category = SubCategory::where('slug', $request->subCategory)->firstOrFail();
            $products = Product::where(['status' => 1, 'is_approved' => 1, 'sub_category_id' => $category->id])
            ->when($request->has('range'), function($query) use ($request){
                $price = explode(';', $request->range);
                return $query->where('price', '>=', $price[0])->where('price', '<=', $price[1]);
            })
            ->paginate(12);
        }elseif($request->has('childCategory')){
            $category = ChildCategory::where('slug', $request->childCategory)->firstOrFail();
            $products = Product::where(['status' => 1, 'is_approved' => 1, 'child_category_id' => $category->id])
            ->when($request->has('range'), function($query) use ($request){
                $price = explode(';', $request->range);
                return $query->where('price', '>=', $price[0])->where('price', '<=', $price[1]);
            })
            ->paginate(12);
        }elseif($request->has('brand')){
            $brand = Brand::where('slug', $request->brand)->firstOrFail();
            $products = Product::where(['status' => 1, 'is_approved' => 1, 'brand_id' => $brand->id])
            ->when($request->has('range'), function($query) use ($request){
                $price = explode(';', $request->range);
                return $query->where('price', '>=', $price[0])->where('price', '<=', $price[1]);
            })
            ->paginate(12);
        }elseif($request->has('search')){
            $products = Product::where(['status' => 1, 'is_approved' => 1])->where(function($query) use ($request){
               $query->where('name', 'like', '%'.$request->search.'%')
                     ->orWhere('long_description', 'like', '%'.$request->search.'%');
            })
            ->orWhereHas('category', function($query) use ($request){
                $query->where(['status' => 1, 'is_approved' => 1])
                      ->where('name', 'like', '%'.$request->search.'%')
                      ->orWhere('long_description', 'like', '%'.$request->search.'%');
            })
            ->paginate(12); 
        }else{
            $products = Product::where(['status' => 1, 'is_approved' => 1])->orderBy('id', 'DESC')->paginate(12);
        }

        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('frontend.pages.products', compact('products','categories','brands'));
    }

    public function changeGirdView(Request $request){
         Session::put('change_gird_view', $request->style);
    }
}
