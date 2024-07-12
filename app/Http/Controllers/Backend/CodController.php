<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cod;
use Illuminate\Http\Request;

class CodController extends Controller
{
    public function update(Request $request){
        $request->validate([
            'status' => 'required'
        ]);

        Cod::updateOrCreate(
            ['id' => 1],
            ['status' => $request->status]
        );

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Cash on delivery successfully'
        ]);
    }
}
