<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Str;

class BrandController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo'=>['required', 'max:2000','image'],
            'name'=>['required', 'max:200'],
            'is_featured'=>['required', 'max:200'],
            'status'=>['required', 'max:200'],
        ]);

        $brand = new Brand();

        $logo = $this->imageUpload($request,'logo', 'uploads');

        $brand->logo = $logo;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

     
        $notification = [
            'message' => 'brand created successfully',
            'alert-type' => 'success'
            ];
        return redirect()->back()->with($notification);
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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);
        
        $logo = $this->imageUpdate($request,'logo', 'uploads', $brand->logo);
    
        $brand->logo = empty(!$logo) ? $logo  : $brand->logo;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        $notification = [
            'message' => 'Updated successfully',
            'alert-type' => 'success'
            ];
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        if(Product::where('brand_id', $brand->id)->count() > 0){
            return response()->json([
                'status'=>'error',
                'message'=>'You can not delete it. Because this brand has product!!!'
            ]);
        }
        $this->brandImageDelete($brand->logo);
        $brand->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'brand item deleted!!!'
        ]);
    }

    public function status(Request $request){
        $childcategory = Brand::findOrFail($request->id);
        $childcategory->status = $request->status == 'true' ? 1 : 0;
        $childcategory->save();
        return response()->json([
            'message'=>'Status updated!',
            'alert-type' => 'success'
        ]);
    }
}
