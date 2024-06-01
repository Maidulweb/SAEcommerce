<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use File;

class VendorProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,VendorProductImageGalleryDataTable $dataTable)
    {
       $product = Product::findOrFail($request->productId); 
       return $dataTable->render('vendor.product.image-gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => ['image'],
        ]);
        $images = $this->multiImageUpload($request, 'images', 'uploads');
         
        foreach($images as $image){
            $productImages = new ProductImageGallery();
            $productImages->images = $image;
            $productImages->product_id = $request->product_id;
            $productImages->save();
        }

        $notification = [
            'message' => 'Multi Images Uploaded successfully',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $multiImage = ProductImageGallery::findOrFail($id);
        if(File::exists(public_path($multiImage->images))){
            File::delete(public_path($multiImage->images));
        }
        $multiImage->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Image deleted!!!'
        ]);
    }
}
