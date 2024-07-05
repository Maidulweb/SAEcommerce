<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VendorCondition;
use Illuminate\Http\Request;

class VendorConditionController extends Controller
{
    public function index(){
        $content = VendorCondition::first();
        return view('admin.vendor-condition.vendor-condition', compact('content'));
    }

    public function update(Request $request){
       $request->validate([
        'content' => 'required'
       ]);

       VendorCondition::updateOrCreate(
        ['id' => 1],
        ['content' => $request->content]
       );

       return redirect()->back()->with([
        'alert-type' => 'success',
        'message' => 'Vendor condition added successfully'
       ]);
    }
}
