<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }

    public function update(Request $request){
       $user = Auth::user();
       $request->validate([
         'name'=>['required'],
         'email'=>['required','email','unique:users,email,'.Auth::user()->id],
       ]);
       
       if($request->hasFile('image')){
        if(File::exists(public_path($user->image))){
          File::delete(public_path($user->image));
        }

        $request->validate([
          'image'=>['image']
        ]);

        $image = $request->image;
        $imageName = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('uploads'), $imageName);
        $path = '/uploads/'.$imageName;
        $user->image = $path;
       }

       $user->name = $request->name;
       $user->email = $request->email;
       
       $user->save();
       
       $notification = array(
        'message' => 'Successfully Done',
        'alert-type' => 'success'
    );
       return redirect()->back()->with($notification);
    }

    public function passwordUpdate(Request $request){
      $request->validate([
        'current_password'=>['required', 'current_password'],
        'password'=>['required','confirmed'],
      ]);

      $request->user()->update([
         'password'=>bcrypt($request->password)
      ]);
      
      return redirect()->back();
    }
}
