<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterInfoController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer_info = FooterInfo::first();
        return view('admin.footer.footer-info.index', compact('footer_info'));
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
        $request->validate([
            'logo' => ['image']
         ]);

         $footer_info = FooterInfo::findOrFail($id);

        $logo = $this->imageUpdate($request, 'logo', 'uploads', $footer_info->logo);

        FooterInfo::updateOrCreate(
            ['id' => 1],
            [
             'logo' => empty(!$logo) ? $logo : $footer_info->logo,
             'email' => $request->email,
             'phone' => $request->phone,
             'address' => $request->address,
            ]
            );

            Cache::forget('footer_info');
            
            return redirect()->route('admin.footer-info.index')->with([
                'alert-type' => 'success',
                'message' => 'Footer info successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
