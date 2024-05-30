<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,ProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->productId);
        return $dataTable->render('admin.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->productId);
        return view('admin.product.product-variant.create', compact('product'));
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
        return redirect()->route('admin.product-variant.index', ['productId'=>$request->product_id])->with($notification);
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
        return view('admin.product.product-variant.edit', compact('variant'));
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
