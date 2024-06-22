<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable){
        return $dataTable->render('frontend.dashboard.order.index');
    }

    public function show($id){
        $order = Order::with('orderProduct')->findOrFail($id);
        return view('frontend.dashboard.order.show', compact(['order']));
    }
}
