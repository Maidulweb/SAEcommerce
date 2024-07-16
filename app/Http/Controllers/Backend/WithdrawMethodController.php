<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\WithdrawMethodDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WithdrawMethodDataTable $datatable)
    {
        return $datatable->render('admin.withdraw-method.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.withdraw-method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'minimum_amount' => ['required','integer','lt:maximum_amount'],
            'maximum_amount' => ['required','integer','gt:minimum_amount'],
            'charge' => ['required','integer'],
            'description' => ['required'],
        ],[
            'name.required' => 'Name field is required!!!',
            'minimum_amount.required' => 'Minimum field is required!!!',
            'maximum_amount.required' => 'Maximum field is required!!!',
            'charge.required' => 'Charge field is required!!!',
            'description.required' => 'Description field is required!!!',
        ]);

        $withdraw = new WithdrawMethod();
        $withdraw->name = $request->name;
        $withdraw->minimum_amount = $request->minimum_amount;
        $withdraw->maximum_amount = $request->maximum_amount;
        $withdraw->charge = $request->charge;
        $withdraw->description = $request->description;
        $withdraw->save();

        return redirect()->route('admin.withdraw.index')->with([
            'message' => 'Withdraw method created successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $withdraw = WithdrawMethod::findOrFail($id);
        return view('admin.withdraw-method.edit', compact('withdraw'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'minimum_amount' => ['required','integer','lt:maximum_amount'],
            'maximum_amount' => ['required','integer','gt:minimum_amount'],
            'charge' => ['required','integer'],
            'description' => ['required'],
        ],[
            'name.required' => 'Name field is required!!!',
            'minimum_amount.required' => 'Minimum field is required!!!',
            'maximum_amount.required' => 'Maximum field is required!!!',
            'charge.required' => 'Charge field is required!!!',
            'description.required' => 'Description field is required!!!',
        ]);

        $withdraw = WithdrawMethod::findOrFail($id);
        $withdraw->name = $request->name;
        $withdraw->minimum_amount = $request->minimum_amount;
        $withdraw->maximum_amount = $request->maximum_amount;
        $withdraw->charge = $request->charge;
        $withdraw->description = $request->description;
        $withdraw->save();

        return redirect()->route('admin.withdraw.index')->with([
            'message' => 'Withdraw method updated successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $withdraw = WithdrawMethod::findOrFail($id);
        $withdraw->delete();

        return response([
            'message' => 'Withdraw Delete',
            'status' => 'success'
        ]);
    }
}
