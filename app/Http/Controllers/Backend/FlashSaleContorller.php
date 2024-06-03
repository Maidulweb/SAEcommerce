<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleContorller extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable){
        $flash_date = FlashSale::first();
        $products = Product::where('is_approved', 1)->where('status', 1)->get();
        return $dataTable->render('admin.product.flash-sale.index', compact(['products', 'flash_date']));
    }

    public function update(Request $request){
       $request->validate([
        'flash_sale_end_date' => ['required']
       ]);

        FlashSale::updateOrCreate(
            ['id' => 1],
            ['flash_sale_end_date' => $request->flash_sale_end_date],
        );

        return redirect()->back()->with([
            'message' => 'Date updated',
            'alert-type' => 'success'
        ]);
    }

    public function store(Request $request){
       $request->validate([
        'product_id' => ['required'],
        'show_at_home' => ['required'],
        'status' => ['required'],
       ]);

      $flashSale = FlashSale::first(); 
      $flashSaleItem = new FlashSaleItem();

      $flashSaleItem->product_id = $request->product_id;
      $flashSaleItem->flash_sale_id = $flashSale->id;
      $flashSaleItem->show_at_home = $request->show_at_home;
      $flashSaleItem->status = $request->status;
      $flashSaleItem->save();

      return redirect()->back()->with([
        'message' => 'Flash sale item created',
        'alert-type' => 'success'
    ]);
    }

    public function status(Request $request){
      $flashSaleItem = FlashSaleItem::findOrFail($request->id);
      $flashSaleItem->status = $request->status == 'true' ? 1 : 0;
      $flashSaleItem->save();
      return response()->json([
        'message' => 'Status updated',
        'alert-type' => 'success'
    ]);
    }

    public function destroy($id) {
        $flashSaleItem = FlashSaleItem::findOrFail($id);
        $flashSaleItem->delete();
      return response()->json([
        'message' => 'Deleted!!!',
        'status' => 'success'
    ]);
    }
}
