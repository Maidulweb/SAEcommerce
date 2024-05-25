<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'max:200'],
            'name' => ['required', 'max:200','unique:sub_categories,name'],
            'status' => ['required', 'max:200'],
        ]);

        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status;
        $subcategory->save();

        $notification = [
            'message' => 'Sub Category created!',
            'alert-type' => 'success'
          ];
        return redirect()->route('admin.sub-category.index')->with($notification);
          
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
        $subcategory = SubCategory::findOrFail($id);
        $category = Category::get();
        return view('admin.sub-category.edit', compact(['subcategory','category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => ['required', 'max:200'],
            'name' => ['required', 'max:200','unique:sub_categories,name,'.$id],
            'status' => ['required', 'max:200'],
        ]);

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status;
        $subcategory->save();

        $notification = [
            'message' => 'Sub Category Updated!',
            'alert-type' => 'success'
          ];
        return redirect()->route('admin.sub-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $childcategory = ChildCategory::where('sub_category_id', $subcategory->id)->count();
        if($childcategory > 0){
            return response()->json([
                'status'=>'error',
                'message'=>"You can't delete it. Because there have $childcategory items child category"
            ]);
        }
        $subcategory->delete();
          return response()->json([
            'status'=>'success',
            'message'=>'Slider item deleted!!!'
        ]);
    }

    public function subcategoryStatus(Request $request){
        $subcategory = SubCategory::findOrFail($request->id);
        $subcategory->status = $request->status == 'true' ? 1 : 0;
        $subcategory->save();
        return response()->json([
            'message'=>'Status updated!',
            'alert-type' => 'success'
        ]);
    }
}
