<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    use ImageUploadTrait;
    public function index(){
        $vendors = Vendor::get();
        return view('frontend.pages.vendor', compact('vendors'));
    }

    public function products(string $id){
        $vendor = Vendor::findOrFail($id);
        $products = Product::where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $id])->paginate(4);
        return view('frontend.pages.vendor-products', compact('products','vendor'));
    }

    public function vendorRequestPage(){
        return view('frontend.dashboard.vendor-request');
    }

    public function vendorRequestCreate(Request $request){
        $request->validate([
            'banner'=>['nullable', 'image'],
            'phone'=>['required'],
            'address'=>['required'],
            'email'=>['required'],
            'description'=>['required'],
        ]);

        $vendor = new Vendor();

        $vendor->shop_name = $request->shop_name;
        $banner = $this->imageUpload($request, 'banner', 'uploads', $vendor->banner);
        $vendor->banner = empty(!$banner) ? $banner : $vendor->banner;
        $vendor->phone = $request->phone;
        $vendor->address = $request->address;
        $vendor->email = $request->email;
        $vendor->description = $request->description;
        $vendor->user_id = Auth::user()->id;
        $vendor->status = 0;
        
        $vendor->save();
        
        $response = [
          'message'=> 'Vendor request successfully',
          'alert-type' => 'success' 
        ];
        return redirect()->back()->with($response);
    }
}
