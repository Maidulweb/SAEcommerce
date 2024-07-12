<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\FooterInfo;
use App\Models\HomepageSetting;
use App\Models\Logo;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Cart;

class HomeController extends Controller
{
    public function home(Request $request){
        $sliders = Slider::where('status',1)->orderBy('serial','asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategoryAll = HomepageSetting::where('key', 'popular_product_setting')->first();
        $brands = Brand::where('is_featured', 1)->get();
        $getTypeProducts = $this->getTypeProducts();
        $singleCategoryAll = HomepageSetting::where('key', 'single_category_product_setting')->first();
        $singleCategoryTwo = HomepageSetting::where('key', 'single_category_two_product_setting')->first();
        $singleCategoryThree = HomepageSetting::where('key', 'single_category_three_product_setting')->first();
        $advertisement = Advertisement::where('key', 'advertisement_banner_one')->first();
        $blogs = Blog::with('category')->where('status', 1)->get();
        return view('frontend.home.home', compact([
            'sliders',
            'flashSaleDate',
            'flashSaleItems',
            'popularCategoryAll',
            'brands',
            'getTypeProducts',
            'singleCategoryAll',
            'singleCategoryTwo',
            'singleCategoryThree',
            'advertisement',
            'blogs'
        ]));
    }

    public function getTypeProducts(){
        $getTypeProducts = [];
        $getTypeProducts['top_product'] = Product::with('productReview')->where(['product_type' => 'top_product','is_approved' => 1, 'status' => 1])->take(8)->orderBy('id', 'DESC')->get();
        $getTypeProducts['new_product'] = Product::with('productReview')->where(['product_type' => 'new_product','is_approved' => 1, 'status' => 1])->take(8)->orderBy('id', 'DESC')->get();
        $getTypeProducts['featured_product'] = Product::with('productReview')->where(['product_type' => 'featured_product','is_approved' => 1, 'status' => 1])->take(8)->orderBy('id', 'DESC')->get();
        $getTypeProducts['best_product'] = Product::with('productReview')->where(['product_type' => 'best_product','is_approved' => 1, 'status' => 1])->take(8)->orderBy('id', 'DESC')->get();

        return $getTypeProducts;
    }
}
