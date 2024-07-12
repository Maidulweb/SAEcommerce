<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $total_user = User::count();
        $total_order = Order::count();
        $today_order = Order::where('created_at', Carbon::today())->count();
        $total_reviews = ProductReview::count();
        $total_earning = Order::where(['order_status' => 'delivered', 'payment_status' => 1])->sum('sub_total');
        $today_earning = Order::where(['order_status' => 'delivered', 'payment_status' => 1])
                         ->where('created_at', Carbon::today())
                         ->sum('sub_total');
        $monthly_earning = Order::where(['order_status' => 'delivered', 'payment_status' => 1])
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->sum('sub_total'); 
        $yearly_earning = Order::where(['order_status' => 'delivered', 'payment_status' => 1])
                        ->whereYear('created_at', Carbon::now()->year)
                        ->sum('sub_total'); 
                                          
        return view('admin.dashboard', compact('total_user','total_order','total_reviews','today_order','total_earning','today_earning','monthly_earning','yearly_earning'));
    }

    public function login(){
        return view('admin.auth.login');
    }
}
