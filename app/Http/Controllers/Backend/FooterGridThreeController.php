<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridThreeDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridThree;
use App\Models\FooterGridTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterGridThreeController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(FooterGridThreeDataTable $datatable)
    {
        return $datatable->render('admin.footer.footer-grid-three.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-grid-three.create');
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

        $footer_grid_three = new FooterGridThree();

        $footer_grid_three->name = $request->name;
        $footer_grid_three->url = $request->url;
        $footer_grid_three->status = $request->status;
        $footer_grid_three->save();

        Cache::forget('footer_grid_threes');

        return redirect()->route('admin.footer-grid-three.index')->with([
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
        $footer_grid_three = FooterGridThree::findOrFail($id);
        return view('admin.footer.footer-grid-three.edit', compact('footer_grid_three'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $footer_grid_three = FooterGridThree::findOrFail($id);

        $request->validate([
            'name' => ['required'],
            'url' => ['required'],
            'status' => ['required'],
        ]);

        $footer_grid_three->name = $request->name;
        $footer_grid_three->url = $request->url;
        $footer_grid_three->status = $request->status;
        $footer_grid_three->save();

        Cache::forget('footer_grid_threes');

        return redirect()->route('admin.footer-grid-three.index')->with([
            'alert-type' => 'success',
            'message' => 'Updated successfully' 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer_grid_three = FooterGridThree::findOrFail($id);
        $footer_grid_three->delete();
        
        Cache::forget('footer_grid_threes');

        return response()->json([
            'status'=>'success',
            'message'=>'footer grid two deleted!!!'
        ]);
    }

    public function FooterGridThreeStatus(Request $request){
        $footer_grid_three = FooterGridThree::findOrFail($request->id);
        $footer_grid_three->status = $request->isChecked == 'true' ? 1 : 0;
        $footer_grid_three->save();

        Cache::forget('footer_grid_threes');

        return response()->json([
         'message' => 'Status updated successfully!',
         'alert-type' => 'success'
     ]);
     }

     public function FooterGridThreetitle(Request $request){
          FooterGridTitle::updateOrCreate(
            ['id' => 1],
            [
                'footer_grid_three_title' => $request->footer_grid_three_title
            ]
          );

          Cache::forget('footer_grid_threes');

          return redirect()->route('admin.footer-grid-three.index')->with([
            'message' => 'footer grid three title created successfully!',
            'alert-type' => 'success'
        ]);
     }
}
