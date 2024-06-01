<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,VendorProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->productId);
        if($product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
           }
        return $dataTable->render('vendor.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->productId);
        return view('vendor.product.product-variant.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $variant = new ProductVariant();

        $variant->name = $request->name;
        $variant->product_id = $request->product_id;
        $variant->status = $request->status;
        $variant->save();

        $notification = [
            'message' => 'Variant created successfully',
            'alert-type' => 'success'
            ];
        return redirect()->route('vendor.product-variant.index', ['productId'=>$request->product_id])->with($notification);
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
        $variant = ProductVariant::findOrFail($id);
        if($variant->product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
           }
        return view('vendor.product.product-variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $variant = ProductVariant::findOrFail($id);
        if($variant->product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
           }
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        $notification = [
            'message' => 'Variant created successfully',
            'alert-type' => 'success'
            ];
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        if($variant->product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
           }
        $variantItem = ProductVariantItem::where('product_variant_id', $variant->id)->count();
        if($variantItem > 0){
            return response()->json([
                'message' => 'You can not delete it. It has item. Please delete first item',
                'status' => 'error'
               ]);
        }
        $variant->delete();

        return response()->json([
            'message' => 'Delete',
            'status' => 'success'
           ]);
    }
    public function status(Request $request){
        $product = ProductVariant::findOrFail($request->id);
        $product->status = $request->is_checked == 'true' ? 1 : 0;
        $product->save();
 
        if($request->is_checked == 'true'){
         return response()->json([
             'message' => 'Status Active',
             'alert-type' => 'success'
            ]);
        }else {
         return response()->json([
             'message' => 'Status Inactive',
             'alert-type' => 'success'
            ]);
        }
     }
}
