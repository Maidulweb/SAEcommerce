<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class BlogController extends Controller
{
    use ImageUploadTrait;
     /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $datatable)
    {
        return $datatable->render('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::get();
        return view('admin.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $blog = new Blog();

        $image = $this->imageUpload($request, 'image', 'uploads');

        $blog->user_id = Auth::user()->id;
        $blog->category_id = $request->category_id;
        $blog->image = $image;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        $blog->save();

        return redirect()->route('admin.blog.index')->with([
            'alert-type' => 'success',
            'message' => 'Blog created successfully'
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
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::get();
        return view('admin.blog.edit', compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $image = $this->imageUpdate($request, 'image', 'uploads', $blog->image);

        $blog->user_id = Auth::user()->id;
        $blog->category_id = $request->category_id;
        $blog->image = !empty($image) ? $image : $blog->image;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        $blog->save();

        return redirect()->route('admin.blog.index')->with([
            'alert-type' => 'success',
            'message' => 'Blog updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $this->sliderImageDelete($blog->image);
        $blog->delete();

        return response([
            'alert-type' => 'success',
            'status' => 'success',
            'message' => 'Delete successfully'
        ]);
    }

    public function status(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog->status = $request->isChecked == 'true' ? 1 : 0;
        $blog->save();

        return response([
            'alert-type' => 'success',
            'status' => 'success',
            'message' => 'status successfully'
        ]);
    }
}
