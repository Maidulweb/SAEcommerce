<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorShopProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('vendor.shop-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner'=>['nullable', 'image'],
            'phone'=>['required'],
            'address'=>['required'],
            'email'=>['required'],
            'description'=>['required'],
        ]);

        $vendor = Vendor::where('user_id', Auth::user()->id)->first();
 
        $banner = $this->imageUpdate($request, 'banner', 'uploads', $vendor->banner);
        $vendor->banner = empty(!$banner) ? $banner : $vendor->banner;
        $vendor->phone = $request->phone;
        $vendor->address = $request->address;
        $vendor->email = $request->email;
        $vendor->description = $request->description;
        $vendor->fb_link = $request->fb_link;
        $vendor->tw_link = $request->tw_link;
        $vendor->insta_link = $request->insta_link;
        $vendor->shop_name = $request->shop_name;
        $vendor->save();
        
        $response = [
          'message'=> 'Vendor updated',
          'alert-type' => 'success' 
        ];
        return redirect()->back()->with($response);
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
        //
    }
}
