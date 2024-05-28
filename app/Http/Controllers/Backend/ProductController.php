<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ProductImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class ProductController extends Controller
{
    use ProductImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $brands = Brand::get();
        return view('admin.product.create', compact(['categories','brands']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'thumb_image' => ['required','image'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required'],
            'long_description' => ['required'],
            'price' => ['required'],
            'status' => ['required']
        ]);

        $product = new Product();
        
        $image = $this->productImageUpload($request, 'thumb_image', 'uploads');

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->thumb_image = $image;
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->child_category_id = $request->child_category_id;
        $product->brand_id = $request->brand_id;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 0;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        $response = [
            'message' => 'Product upload successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.product.index')->with($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = subCategory::where('category_id', $product->category_id)->get();
        $childcategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands = Brand::all();

        return view('admin.product.edit', compact(['product','categories','subcategories','childcategories','brands']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required'],
            'long_description' => ['required'],
            'price' => ['required'],
            'status' => ['required']
        ]);

        $product = Product::findOrFail($id);
        
        $image = $this->productImageUpdate($request, 'thumb_image', 'uploads', $product->thumb_image);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->thumb_image = empty(!$image) ? $image :  $product->thumb_image;
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->child_category_id = $request->child_category_id;
        $product->brand_id = $request->brand_id;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 0;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        $response = [
            'message' => 'Product updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.product.index')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->productImageDelete($product->thumb_image);
        $product->delete();

        return redirect()->back()->response([
            'message' => 'Product Delete',
            'status' => 'success'
        ]);
    }

    public function subCategory(Request $request){
        $subcategory = SubCategory::where('category_id', $request->id)->get();
        return $subcategory;
    }
    
    public function childCategory(Request $request){
        $childcategory = ChildCategory::where('sub_category_id', $request->id)->get();
        return $childcategory;
    }

    public function status(Request $request){
       $product = Product::findOrFail($request->id);
       $product->status = $request->is_checked == 'true' ? 1 : 0;
       $product->save();

       if($request->is_checked == 'true'){
        return response()->json([
            'message' => 'Status Active',
            'alert-type' => 'success'
           ]);
       }else {
        return response()->json([
            'message' => 'Status Inactive',
            'alert-type' => 'success'
           ]);
       }

       
    }
}
