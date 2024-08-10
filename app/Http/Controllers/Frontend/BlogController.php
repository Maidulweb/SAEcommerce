<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $blogs = Blog::with('category')->where('title', 'like', '%'.$request->search.'%')->where('status', 1)->paginate(3);
        }else{
            $blogs = Blog::with('category')->where('status', 1)->paginate(3);
        }
        return view('frontend.blog.blog-all', compact('blogs'));
    }

    public function singleBlog(string $slug){
        $blog = Blog::with('category')->where('slug', $slug)->first();
        $categories = BlogCategory::get();
        $blog_comments = BlogComment::where('blog_id', $blog->id)->paginate(3);
        $blog_mores = Blog::with('category')->where('slug', '!=', $slug)->take(5)->orderBy('id', 'DESC')->get();
        return view('frontend.blog.blog-single', compact('blog','categories','blog_comments','blog_mores'));
    }

    public function categoryBlogPost($id){
        $blogs = Blog::with('category')->where(['status'=> 1, 'category_id' => $id])->paginate(3);
        return view('frontend.blog.blog-all', compact('blogs'));
    }

    public function comment(Request $request){
         $request->validate([
            'comment' => 'required'
         ]);

         $blog_comment = new BlogComment();

         $blog_comment->user_id = Auth::user()->id;
         $blog_comment->blog_id = $request->blog_id;
         $blog_comment->comment = $request->comment;
         $blog_comment->save();

         return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Comment successfully'
         ]);
    }
}
