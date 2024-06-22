<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\OrderDataTable;
use App\DataTables\OrderDeliveredDataTable;
use App\DataTables\OrderDroppedDataTable;
use App\DataTables\OrderOutDeliveredDataTable;
use App\DataTables\OrderPendingDataTable;
use App\DataTables\OrderProcessedDataTable;
use App\DataTables\OrderShippedDataTable;
use App\DataTables\PendingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index'); 
    }
    
    public function orderPending(OrderPendingDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending'); 
    }

    public function orderProcessed(OrderProcessedDataTable $dataTable)
    {
        return $dataTable->render('admin.order.processed'); 
    }

    public function orderDropped(OrderDroppedDataTable $dataTable)
    {
        return $dataTable->render('admin.order.dropped'); 
    }

    public function orderShipped(OrderShippedDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped'); 
    }

    public function orderOutDelivered(OrderOutDeliveredDataTable $dataTable)
    {
        return $dataTable->render('admin.order.out_delivered'); 
    }

    public function orderDelivered(OrderDeliveredDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered'); 
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact(['order']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->orderProduct()->delete();
        $order->transaction()->delete();
        $order->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Order'
        ]);
    }

    public function changeOrderStatus(Request $request){
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        return response()->json([
            'alert-status' => 'success',
             'status' => 200,
             'message' => 'Order status changed'
        ]);
    }

    public function changePaymentStatus(Request $request){
        $order = Order::findOrFail($request->id);
        $order->payment_status = $request->payment_status;
        $order->save();

        return response()->json([
            'alert-status' => 'success',
             'status' => 200,
             'message' => 'Order Payment status changed'
        ]);
    }
}
