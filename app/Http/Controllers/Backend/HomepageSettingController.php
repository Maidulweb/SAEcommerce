<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;

class HomepageSettingController extends Controller
{
    public function index(){
        $categories = Category::get();
        $popular = HomepageSetting::where('key', 'popular_product_setting')->first();
        $single_category = HomepageSetting::where('key', 'single_category_product_setting')->first();
        $single_category_two = HomepageSetting::where('key', 'single_category_two_product_setting')->first();
        $single_category_three = HomepageSetting::where('key', 'single_category_three_product_setting')->first();
        return view('admin.homepage.index', compact(['categories','popular','single_category','single_category_two','single_category_three']));
    }

    public function PopularProductUpdate(Request $request){
      $data = [
        [
           'category' => $request->cat_one,
           'sub_category' => $request->sub_cat_one,
           'child_category' => $request->child_cat_one,
        ],
        [
           'category' => $request->cat_two,
           'sub_category' => $request->sub_cat_two,
           'child_category' => $request->child_cat_two,
        ],
        [
           'category' => $request->cat_three,
           'sub_category' => $request->sub_cat_three,
           'child_category' => $request->child_cat_three,
        ],
        [
           'category' => $request->cat_four,
           'sub_category' => $request->sub_cat_four,
           'child_category' => $request->child_cat_four,
        ]
      ];

      HomepageSetting::updateOrCreate(
        [
            'key' => 'popular_product_setting'
        ],
        [
            'value' => json_encode($data)
        ]
      );

      return redirect()->back()->with([
        'alert-type' => 'success',
        'message' => 'Popular product setting successfully'
      ]);
    }

    public function singleCategoryProduct(Request $request){
      $request->validate([
        'single_cat' => 'required'
      ]);
      $data = [
           'category' => $request->single_cat,
           'sub_category' => $request->single_sub_cat,
           'child_category' => $request->single_child_cat
           ];

      HomepageSetting::updateOrCreate(
        [
            'key' => 'single_category_product_setting'
        ],
        [
            'value' => json_encode($data)
        ]
      );

      return redirect()->back()->with([
        'alert-type' => 'success',
        'message' => 'Single category product setting successfully'
      ]);
    }

    public function singleCategoryTwoProduct(Request $request){
      $request->validate([
        'single_cat' => 'required'
      ]);
      $data = [
           'category' => $request->single_cat,
           'sub_category' => $request->single_sub_cat,
           'child_category' => $request->single_child_cat
           ];

      HomepageSetting::updateOrCreate(
        [
            'key' => 'single_category_two_product_setting'
        ],
        [
            'value' => json_encode($data)
        ]
      );

      return redirect()->back()->with([
        'alert-type' => 'success',
        'message' => 'Single category two product setting successfully'
      ]);
    }

    public function singleCategoryThreeProduct(Request $request){
      $request->validate([
        'single_cat_one' => 'required',
      ]);
      $data = [
           [
            'category' => $request->single_cat_one,
           'sub_category' => $request->single_sub_cat_one,
           'child_category' => $request->single_child_cat_one
           ],
           [
            'category' => $request->single_cat_two,
           'sub_category' => $request->single_sub_cat_two,
           'child_category' => $request->single_child_cat_two
           ]
           ];

      HomepageSetting::updateOrCreate(
        [
            'key' => 'single_category_three_product_setting'
        ],
        [
            'value' => json_encode($data)
        ]
      );

      return redirect()->back()->with([
        'alert-type' => 'success',
        'message' => 'Single category three product setting successfully'
      ]);
    }
}
