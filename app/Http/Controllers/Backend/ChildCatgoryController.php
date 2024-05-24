<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class ChildCatgoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.child-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'=>['required'],
            'sub_category_id'=>['required'],
            'name'=>['required'],
            'status'=>['required']
        ]);

        $childcategory = new ChildCategory();
        $childcategory->category_id = $request->category_id;
        $childcategory->sub_category_id = $request->sub_category_id;
        $childcategory->name = $request->name;
        $childcategory->slug = Str::slug($request->name);
        $childcategory->status = $request->status;
        $childcategory->save();

        $notification = [
            'message' => 'Successfully Done',
            'alert-type' => 'success'
          ];
          return redirect()->route('admin.child-category.index')->with($notification);
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
        $categories = Category::get();
        $childcategory = ChildCategory::findOrFail($id);
        $subcategories = SubCategory::where('category_id', $childcategory->category_id)->get();

        return view('admin.child-category.edit', compact(['categories', 'subcategories','childcategory']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $childcategory = ChildCategory::findOrFail($id);

        $request->validate([
            'category_id'=>['required'],
            'sub_category_id'=>['required'],
            'name'=>['required'],
            'status'=>['required']
        ]);

        $childcategory->category_id = $request->category_id;
        $childcategory->sub_category_id = $request->sub_category_id;
        $childcategory->name = $request->name;
        $childcategory->slug = Str::slug($request->name);
        $childcategory->status = $request->status;
        $childcategory->save();

        $notification = [
            'message' => 'Updated!!!',
            'alert-type' => 'success'
          ];
          return redirect()->route('admin.child-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childcategory = ChildCategory::findOrFail($id);
        $childcategory->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Category deleted!!!'
        ]);
    }
    public function childcategorySubCategory(Request $request){
         $subcategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
         return $subcategories;
    }

    public function childcategoryStatus(Request $request){
        $childcategory = ChildCategory::findOrFail($request->id);
        $childcategory->status = $request->status == 'true' ? 1 : 0;
        $childcategory->save();
        return response()->json([
            'message'=>'Status updated!',
            'alert-type' => 'success'
        ]);
    }
}
