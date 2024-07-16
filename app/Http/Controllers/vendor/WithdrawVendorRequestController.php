<?php

namespace App\Http\Controllers\vendor;

use App\DataTables\WithdrawVendorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use App\Models\WithdrawVendorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WithdrawVendorRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WithdrawVendorRequestDataTable $datatable)
    {
        return $datatable->render('vendor.withdraw-request.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $methods = WithdrawMethod::get();
        return view('vendor.withdraw-request.create', compact('methods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'method' => 'required',
            'method' => 'required',
            'amount' => 'required',
            'account_info' => 'required',
        ]);
       
        $method = WithdrawMethod::findOrFail($request->method);

        if($request->amount < $method->minimum_amount || $request->amount > $method->maximum_amount){
           throw ValidationException::withMessages(['Please 100 - 1000']);
        }

        $withdraw = new WithdrawVendorRequest();
        $withdraw->vendor_id = Auth::user()->id;
        $withdraw->method = $request->method;
        $withdraw->total_amount = $request->amount;
        $withdraw->withdraw_amount = $request->amount - ($request->amount * ($method->charge / 100));
        $withdraw->charge = $request->amount * ($method->charge / 100);
        $withdraw->account_info = $request->account_info;
        $withdraw->save();

        return redirect()->route('vendor.withdraw.index')->with([
            'alert-type' => 'success',
            'message' => 'Withdraw request successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $method = WithdrawMethod::findOrFail($id);

        return response($method);
    }

    public function view(string $id)
    {
        $method = WithdrawVendorRequest::findOrFail($id);

        return view('vendor.withdraw-request.view', compact('method'));
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
        //
    }
}
