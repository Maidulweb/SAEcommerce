<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index(){
        $wishlistProduct = WishList::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
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
            $deleteCount = WishList::where('user_id',Auth::user()->id)->count();
            return response([
                'alert-type' => 'success',
                'status' => 'info',
                'message' => 'Remove successfully!',
                'deletecount' => $deleteCount
            ]);
        }

        


        $wishlist = new WishList();
        $wishlist->product_id = $request->id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();
        $addCount = WishList::where('user_id',Auth::user()->id)->count();
        return response([
            'status' => 'success',
            'alert-type' => 'success',
            'message' => 'Wishlist successfully added!',
            'addcount' => $addCount
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
