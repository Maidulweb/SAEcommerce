<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCommentDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index(BlogCommentDataTable $datatable){
      return $datatable->render('admin.blog.blog-comment');
    }

    public function destroy(string $id)
    {
        $blog = BlogComment::findOrFail($id);
        $blog->delete();

        return response([
            'alert-type' => 'success',
            'status' => 'success',
            'message' => 'Delete successfully'
        ]);
    }
}
