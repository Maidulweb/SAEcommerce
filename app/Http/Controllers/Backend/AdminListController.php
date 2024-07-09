<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use function Termwind\render;

class AdminListController extends Controller
{
    public function index(AdminListDataTable $datatable){
        return $datatable->render('admin.admin-list.admin-list');
    }

    public function adminListStatus(Request $request){

        $admin_list = User::findOrFail($request->id);
        $admin_list->status = $request->isChecked == 'true' ? 'active' : 'inactive';
        $admin_list->save();

        return response([
            'status' => 'success',
            'alert-type' => 'success',
            'message' => 'Successfully done'

        ]);
    }

    public function destroy($id){
        
        $admin_list = User::findOrFail($id);
        $admin_list->delete();

        return response([
            'status' => 'success',
            'alert-type' => 'success',
            'message' => 'Successfully done'

        ]);
    }
}
