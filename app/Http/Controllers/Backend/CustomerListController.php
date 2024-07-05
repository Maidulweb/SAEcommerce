<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CustomerListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function index(CustomerListDataTable $datatable){
        return $datatable->render('admin.customer-list.customer-list');
    }

    public function customerStatus(Request $request){
        $user = User::findOrFail($request->id);
        $user->status = $request->isChecked == 'true' ? 'active' : 'inactive';
        $user->save();

        return response()->json([
            'alert-status' => 'success',
             'status' => 200,
             'message' => 'Customer list status changed'
        ]);
    }
}
