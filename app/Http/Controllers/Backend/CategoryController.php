<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'max:200', 'unique:categories,name'],
            'slug'=>['max:200'],
            'icon'=>['required', 'max:200'],
            'status'=>['required', 'max:200'],
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->status = $request->status;
        $category->save();

        $notification = [
            'message' => 'Category created successfully!',
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name'=>['required', 'max:200', 'unique:categories,name,'.$category->id],
            'slug'=>['max:200'],
            'icon'=>['required', 'max:200'],
            'status'=>['required', 'max:200'],
        ]);


        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->status = $request->status;
        $category->save();

        $notification = [
            'message' => 'Category updated successfully!',
            'alert-type' => 'success'
          ];
          return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Slider item deleted!!!'
        ]);
    }

    public function categoryStatus(Request $request){
       $category = Category::findOrFail($request->id);
       $category->status = $request->isChecked == 'true' ? 1 : 0;
       $category->save();
       return response()->json([
        'message' => 'Status updated successfully!',
        'alert-type' => 'success'
    ]);
    }
}