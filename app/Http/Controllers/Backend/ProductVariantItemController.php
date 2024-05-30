<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(Request $request,ProductVariantItemDataTable $dataTable ){
        $product = Product::findOrFail($request->productId);
        $variant = ProductVariant::findOrFail($request->variantId);
        return $dataTable->render('admin.product.product-variant-item.index', compact(['product', 'variant']));
    }    

    public function create($productId,$variantId ){
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return view('admin.product.product-variant-item.create',compact(['product','variant']));
    }

    public function store(Request $request){
        $request->validate([
            'name'=> ['required'],
            'price'=> ['required'],
        ]);

        $productVariantItem = new ProductVariantItem();

        $productVariantItem->product_variant_id = $request->variant_id;
        $productVariantItem->name = $request->name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;
        $productVariantItem->save();

        $response = [
            'message' => 'Item created',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.product-variant-item.index',['productId'=>$request->product_id,'variantId'=>$request->variant_id])->with($response);
    }

    public function edit($variantId){
        $variant = ProductVariantItem::findOrFail($variantId);
        return view('admin.product.product-variant-item.edit', compact('variant'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=> ['required'],
            'price'=> ['required'],
        ]);

        $productVariantItem = ProductVariantItem::findOrFail($id);

        $productVariantItem->name = $request->name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;
        $productVariantItem->save();

        $response = [
            'message' => 'Item updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.product-variant-item.index',['productId'=>$productVariantItem->productVariant->product_id,'variantId'=>$productVariantItem->product_variant_id])->with($response);
    }

    public function destroy($id){
    
        $productVariantItem = ProductVariantItem::findOrFail($id);
        $productVariantItem->delete();

       return response()->json([
        'message' => 'Delete',
         'status' => 'success' 
       ]);
    }



    public function status(Request $request){
       $variant = ProductVariantItem::findOrFail($request->id);

       $variant->status = $request->status == 'true' ? 1 : 0;
       $variant->save();

       if($request->status == 'true'){
         return response()->json([
            'message' => 'Active',
            'alert-type' => 'success'
         ]);
       }else {
        return response()->json([
            'message' => 'Inactive',
            'alert-type' => 'success'
         ]);
       }
    }
}
