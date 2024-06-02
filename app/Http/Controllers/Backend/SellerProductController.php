<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PendingProductDataTable;
use App\DataTables\SellerProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index(SellerProductDataTable $dataTable){
         return $dataTable->render('admin.product.seller-product.index');        
    }
    public function sellerProductPending(Request $request){
         $product = Product::findOrFail($request->id);
         $product->is_approved = $request->pending;
         $product->save();

         return response()->json([
            'message' => 'Product is pending',
            'alert-type' => 'success'
         ]);
    }
    public function pendingProduct(PendingProductDataTable $dataTable){
        return $dataTable->render('admin.product.pending-product.index');        
   }
   public function sellerProductApproved(Request $request){
    $product = Product::findOrFail($request->id);
    $product->is_approved = $request->pending;
    $product->save();

    return response()->json([
       'message' => 'Product is approved',
       'alert-type' => 'success'
    ]);
   }
}
