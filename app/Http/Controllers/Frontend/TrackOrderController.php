<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TrackOrderController extends Controller
{
    public function index(Request $request){
        if($request->has('invoice_id')){
            $track_order = Order::where('invoice_id', $request->invoice_id)->first();
           
            return view('frontend.track-order.track-order', compact('track_order'));
        }else{
            return view('frontend.track-order.track-order');
        }
    }
}
