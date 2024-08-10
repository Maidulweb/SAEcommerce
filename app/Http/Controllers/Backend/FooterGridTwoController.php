<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridTwoDataTable;
use App\Http\Controllers\Controller;
use App\Models\FootergridTitle;
use App\Models\FooterGridTwo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterGridTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridTwoDataTable $datatable)
    {
        return $datatable->render('admin.footer.footer-grid-two.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-grid-two.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'url' => ['required'],
            'status' => ['required'],
        ]);

        $footer_grid_tow = new FooterGridTwo();

        $footer_grid_tow->name = $request->name;
        $footer_grid_tow->url = $request->url;
        $footer_grid_tow->status = $request->status;
        $footer_grid_tow->save();

        Cache::forget('footer_grid_twos');

        return redirect()->route('admin.footer-grid-two.index')->with([
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
        $footer_grid_two = FooterGridTwo::findOrFail($id);
        return view('admin.footer.footer-grid-two.edit', compact('footer_grid_two'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $footer_grid_two = FooterGridTwo::findOrFail($id);

        $request->validate([
            'name' => ['required'],
            'url' => ['required'],
            'status' => ['required'],
        ]);

        $footer_grid_two->name = $request->name;
        $footer_grid_two->url = $request->url;
        $footer_grid_two->status = $request->status;
        $footer_grid_two->save();

        Cache::forget('footer_grid_twos');

        return redirect()->route('admin.footer-grid-two.index')->with([
            'alert-type' => 'success',
            'message' => 'Updated successfully' 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer_grid_two = FooterGridTwo::findOrFail($id);
        $footer_grid_two->delete();

        Cache::forget('footer_grid_twos');

        return response()->json([
            'status'=>'success',
            'message'=>'footer grid two deleted!!!'
        ]);
    }

    public function footergridTwoStatus(Request $request){
        $footer_grid_two = FooterGridTwo::findOrFail($request->id);
        $footer_grid_two->status = $request->isChecked == 'true' ? 1 : 0;
        $footer_grid_two->save();

        Cache::forget('footer_grid_twos');

        return response()->json([
         'message' => 'Status updated successfully!',
         'alert-type' => 'success'
     ]);
     }

     public function footerGridTwotitle(Request $request){
          FootergridTitle::updateOrCreate(
            ['id' => 1],
            [
                'footer_grid_two_title' => $request->footer_grid_two_title
            ]
          );

          Cache::forget('footer_grid_twos');
          
          return redirect()->route('admin.footer-grid-two.index')->with([
            'message' => 'footer grid two title created successfully!',
            'alert-type' => 'success'
        ]);
     }
}
