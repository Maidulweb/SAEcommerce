<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductReviewDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorProductReviewController extends Controller
{
    public function index(VendorProductReviewDataTable $datatable){
        return $datatable->render('vendor.dashboard.product-review');
    }
}
