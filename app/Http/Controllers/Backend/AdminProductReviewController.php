<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminProductReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminProductReviewController extends Controller
{
    public function index(AdminProductReviewDataTable $datatable){
       return $datatable->render('admin.product-review.product-review');
    }

    public function status(Request $request){
        $product_review = ProductReview::findOrFail($request->id);
        $product_review->status = $request->isChecked == 'true' ? 1 : 0;
        $product_review->save();
        return response()->json([
         'message' => 'Status updated successfully!',
         'alert-type' => 'success'
     ]);
    }
}
