<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminVendorWithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawVendorRequest;
use Illuminate\Http\Request;

class AdminVendorWithdrawRequestController extends Controller
{
    public function index(AdminVendorWithdrawRequestDataTable $datatable){
        return $datatable->render('admin.withdraw-request.index');
    }

    public function show($id){
        $method = WithdrawVendorRequest::findOrFail($id);
        return view('admin.withdraw-request.show',compact('method'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'status' => ['required']
        ]);
        $method = WithdrawVendorRequest::findOrFail($id);
        $method->status = $request->status;
        $method->save();
        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Successfully updated'
        ]); 
    }
}
