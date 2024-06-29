<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index(){
        $wishlistProduct = WishList::where('user_id', Auth::user()->id)->get();
        return view('frontend.pages.wishlist', compact('wishlistProduct'));
    }

    public function store(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
        }
         
        $wishlistCount = WishList::where(['product_id' => $request->id, 'user_id' => Auth::user()->id])->count();
        if($wishlistCount > 0){
            $wishlistId = WishList::where(['product_id' => $request->id, 'user_id' => Auth::user()->id])->first();
            $wishlistId->delete();
            return response([
                'alert-type' => 'success',
                'message' => 'Remove successfully!'
            ]);
        }

        $wishlist = new WishList();
        $wishlist->product_id = $request->id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();

        return response([
            'alert-type' => 'success',
            'message' => 'Wishlist successfully added!'
        ]);
    }

    public function destroy($id){
      $wishlist = WishList::findOrFail($id);
      if($wishlist->user_id != Auth::user()->id){
        return redirect()->back();
      }

      $wishlist->delete();

      return redirect()->back()->with([
        'alert-type' => 'success',
        'message' => 'Remove successfully'
      ]);
      
    }
}
