<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class VendorProfileController extends Controller
{
    public function index(){
        return view('vendor.dashboard.profile');
     }
 
     public function profileUpdate(Request $request){
 
         $user = Auth::user();
 
         $request->validate([
             'name'=>['required'],
             'email' =>['required', 'email', 'unique:users,email,'.$user->id]
         ]);
 
         if($request->hasFile('image')){
             if(File::exists(public_path($user->image))){
                 File::delete(public_path($user->image));
             }
 
             $image = $request->image;
             $imageName = rand().'_'.$image->getClientOriginalName();
             $image->move(public_path('uploads'), $imageName);
             $user->image = '/uploads/'.$imageName;
         }
 
         $user->name = $request->name;
         $user->username = $request->username;
         $user->email = $request->email;
         $user->phone = $request->phone;
         $user->save();
 
         $notification = [
             'message' => 'Vendor Profile updated!!!',
             'alert-type' => 'success'
              ];
         return redirect()->back()->with($notification);
     }
     
     public function passwordUpdate(Request $request){
         $request->validate([
             'current_password' => ['required', 'current_password'],
             'password' => ['required', 'confirmed'],
         ]);
 
         $request->user()->update([
             'password' => bcrypt($request->password)
         ]);
 
         $notification = [
             'message' => 'Vendor password updated!!!',
             'alert-type' => 'success'
              ];
         return redirect()->back()->with($notification);
     }
}
