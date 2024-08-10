<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterSocialDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialDataTable $datatable)
    {
        return $datatable->render('admin.footer.footer-social.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-social.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required'],
            'name' => ['required'],
            'url' => ['required'],
            'status' => ['required'],
        ]);

        $footer_social = new FooterSocial();

        $footer_social->icon = $request->icon;
        $footer_social->name = $request->name;
        $footer_social->url = $request->url;
        $footer_social->status = $request->status;
        $footer_social->save();
         
        Cache::forget('footer_socials');

        return redirect()->route('admin.footer-social.index')->with([
            'alert-type' => 'success',
            'message' => 'Created successfully' 
        ]);
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
        $footer_social = FooterSocial::findOrFail($id);
        return view('admin.footer.footer-social.edit', compact('footer_social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $footer_social = FooterSocial::findOrFail($id);

        $request->validate([
            'icon' => ['required'],
            'name' => ['required'],
            'url' => ['required'],
            'status' => ['required'],
        ]);

        $footer_social->icon = $request->icon;
        $footer_social->name = $request->name;
        $footer_social->url = $request->url;
        $footer_social->status = $request->status;
        $footer_social->save();

        Cache::forget('footer_socials');

        return redirect()->route('admin.footer-social.index')->with([
            'alert-type' => 'success',
            'message' => 'Updated successfully' 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer_social = FooterSocial::findOrFail($id);
        $footer_social->delete();

        Cache::forget('footer_socials');

        return response()->json([
            'status'=>'success',
            'message'=>'footer social deleted!!!'
        ]);
    }

    public function footerSocialStatus(Request $request){
        $footer_social = FooterSocial::findOrFail($request->id);
        $footer_social->status = $request->isChecked == 'true' ? 1 : 0;
        $footer_social->save();
        
        Cache::forget('footer_socials');

        return response()->json([
         'message' => 'Status updated successfully!',
         'alert-type' => 'success'
     ]);
     }
}
