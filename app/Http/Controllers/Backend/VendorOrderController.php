<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function index(VendorOrderDataTable $dataTable){
        return $dataTable->render('vendor.order.index');
    }
    public function show($id){
        $order = Order::with('orderProduct')->findOrFail($id);
        return view('vendor.order.show', compact(['order']));
    }
    public function changeOrderStatus(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        return redirect()->back()->with([
            'alert-status' => 'success',
             'message' => 'Order status changed'
        ]);
    }

    
}
