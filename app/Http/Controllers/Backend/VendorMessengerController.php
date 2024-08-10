<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VendorMessengerController extends Controller
{
    function index():View {
        return view('vendor.dashboard.messenger.index');
    }
}
