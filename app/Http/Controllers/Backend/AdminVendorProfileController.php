<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorListDataTable;
use App\DataTables\VendorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('admin.vendor-profile.index', compact('profile'));
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

    public function vendorRequest(VendorRequestDataTable $datatable){
        return $datatable->render('admin.vendor-profile.vendor-request-all');
    }

    public function vendorRequestSingle(string $id){
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor-profile.vendor-request-single', compact('vendor'));
    }

    public function vendorRequestStatus(Request $request, $id){
        $vendor = Vendor::findOrFail($id);
        $vendor->status = $request->status;
        $vendor->save();

        $user = User::findOrFail($vendor->user_id);
        $user->role = 'vendor';
        $user->save();

        return redirect()->route('admin.vendor-request')->with([
            'alert-type' => 'success',
            'message' => 'Updated vendor'
        ]);
    }

    public function vendorList(VendorListDataTable $datatable){
        return $datatable->render('admin.vendor-list.vendor-list');
    }

    public function vendorListStatus(Request $request){
        $user = User::findOrFail($request->id);
        $user->status = $request->isChecked == 'true' ? 'active' : 'inactive';
        $user->save();

        return response()->json([
            'alert-status' => 'success',
             'status' => 200,
             'message' => 'User status changed'
        ]);
    }
}
