<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use App\Models\RazorpaySetting;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index(){
        $paypalData = PaypalSetting::first();
        $stripeData = StripeSetting::first();
        return view('admin.payment-setting.index', compact(['paypalData','stripeData']));
    }
}
