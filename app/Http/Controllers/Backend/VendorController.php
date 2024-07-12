<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class VendorController extends Controller
{
    public function dashboard(){

        $pending_order = Order::where('order_status', 'pending')->whereHas('orderProduct', function($query){
                         $query->where('vendor_id', Auth::user()->vendor->id);
                         })->count();

        $delivered_order = Order::where('order_status', 'delivered')->whereHas('orderProduct', function($query){
                        $query->where('vendor_id', Auth::user()->vendor->id);
                        })->count();

        $today_earning = Order::where('order_status', 'delivered')
                        ->whereDate('created_at', Carbon::today())
                        ->whereHas('orderProduct', function($query){
                           $query->where('vendor_id', Auth::user()->vendor->id);
                         })->sum('sub_total');

        $monthly_earning = Order::where('order_status', 'delivered')
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->whereHas('orderProduct', function($query){
                        $query->where('vendor_id', Auth::user()->vendor->id);
                        })->sum('sub_total');
                
        $year_earning = Order::where('order_status', 'delivered')
                        ->whereYear('created_at', Carbon::now()->year)
                        ->whereHas('orderProduct', function($query){
                        $query->where('vendor_id', Auth::user()->vendor->id);
                        })->sum('sub_total');

        $total_earning = Order::where('order_status', 'delivered')
                        ->whereHas('orderProduct', function($query){
                        $query->where('vendor_id', Auth::user()->vendor->id);
                        })->sum('sub_total');                   

        return view('vendor.dashboard.dashboard', compact('pending_order','delivered_order','today_earning','monthly_earning','year_earning','total_earning'));
    }

    
}
