<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserProductReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Termwind\render;

class ProductReviewController extends Controller
{
    use ImageUploadTrait; 
    public function index(UserProductReviewDataTable $datatable){
          return $datatable->render('frontend.dashboard.product-review');
    }
    public function create(Request $request){
       $request->validate([
        'rating' => 'required',
        'review' => 'required',
        'images.*' => ['required','image'],
        'product_id' => 'required',
        'vendor_id' => 'required'
       ]);

      
       $product_review = new ProductReview();

       $product_review->product_id = $request->product_id; 
       $product_review->user_id = Auth::user()->id; 
       $product_review->vendor_id = $request->vendor_id; 
       $product_review->rating = $request->rating; 
       $product_review->review = $request->review; 
       $product_review->status = 0; 
       $product_review->save();
       
       $uploadImages = $this->multiImageUpload($request,'images','uploads');

       if($uploadImages){
        
        foreach($uploadImages as $uploadImage){
            $images = new ProductReviewGallery();
            $images->product_review_id = $product_review->id;
            $images->images = $uploadImage;
            $images->save();
           }
           
       }
       
       return redirect()->back()->with([
        'alert-type' => 'success',
        'message' => 'Product review created'
       ]);

    }


}
