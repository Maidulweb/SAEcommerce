<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ManageUserController extends Controller
{
    public function index(){
        return view('admin.manage-user.manage-user');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => ['required','unique:users,email'],
            'password' => ['required','confirmed'],
            'role' => ['required'],
        ]);

        $manage_user = new User();

        if($request->role == 'admin'){
            $manage_user->name = $request->name;
            $manage_user->email = $request->email;
            $manage_user->password = $request->password;
            $manage_user->role = $request->role;
            $manage_user->status = 'active';
            $manage_user->save();

            Mail::to($request->email)->Send(new AccountCreated($request->name,$request->email));

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Account created'
            ]);

        }elseif($request->role == 'vendor'){
            $manage_user->name = $request->name;
            $manage_user->email = $request->email;
            $manage_user->password = $request->password;
            $manage_user->role = $request->role;
            $manage_user->status = 'active';
            $manage_user->save();

            $vendor = new Vendor();
           $vendor->banner = 'uploads/560437902_dinersclub.png';
           $vendor->phone = '01222222';
           $vendor->address = 'Rangpur';
           $vendor->email = 'adminvendor@gmail.com';
           $vendor->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, ab earum. Tenetur, possimus quo. Necessitatibus eveniet laudantium exercitationem voluptas enim corrupti quaerat maxime sapiente nisi blanditiis. Ipsa similique quod fugit!';
           $vendor->user_id = $manage_user->id;
           $vendor->shop_name = 'demo shop';
           $vendor->status = 1;
           $vendor->save();

           Mail::to($request->email)->Send(new AccountCreated($request->name,$request->email));

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Account created'
            ]);
        }elseif($request->role == 'user'){
            $manage_user->name = $request->name;
            $manage_user->email = $request->email;
            $manage_user->password = $request->password;
            $manage_user->role = $request->role;
            $manage_user->status = 'active';
            $manage_user->save();
            Mail::to($request->email)->Send(new AccountCreated($request->name,$request->email));
            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Account created'
            ]);
        }
    }
}
