<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $datatable)
    {
        return $datatable->render('admin.blog.blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $blog_category = new BlogCategory();

        $blog_category->name = $request->name;
        $blog_category->slug = Str::slug($request->name);
        $blog_category->status = $request->status;
        $blog_category->save();

        return redirect()->route('admin.blog-category.index')->with([
            'alert-type' => 'success',
            'message' => 'Blog category created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        return view('admin.blog.blog-category.edit', compact('blog_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $blog_category = BlogCategory::findOrFail($id);

        $blog_category->name = $request->name;
        $blog_category->slug = Str::slug($request->name);
        $blog_category->status = $request->status;
        $blog_category->save();

        return redirect()->route('admin.blog-category.index')->with([
            'alert-type' => 'success',
            'message' => 'Blog category updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        $blog_category->save();

        return response([
            'alert-type' => 'success',
            'status' => 'success',
            'message' => 'Delete successfully'
        ]);
    }

    public function status(Request $request)
    {
        $blog_category = BlogCategory::findOrFail($request->id);
        $blog_category->status = $request->isChecked == 'true' ? 1 : 0;
        $blog_category->save();

        return response([
            'alert-type' => 'success',
            'status' => 'success',
            'message' => 'status successfully'
        ]);
    }
}
