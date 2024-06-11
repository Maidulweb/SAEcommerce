<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(){
        $userAddresses = UserAddress::where('user_id', Auth::user()->id)->get();
        $shippingRules = ShippingRule::where('status', 1)->get();
        return view('frontend.pages.checkout', compact(['userAddresses', 'shippingRules']));
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required'],
        ]);

        $userAddress = new UserAddress();
        $userAddress->user_id = Auth::user()->id;
        $userAddress->name = $request->name;
        $userAddress->email = $request->email;
        $userAddress->phone = $request->phone;
        $userAddress->country = $request->country;
        $userAddress->state = $request->state;
        $userAddress->city = $request->city;
        $userAddress->zip_code = $request->zip_code;
        $userAddress->address = $request->address;
        $userAddress->save();

        return redirect()->route('user.checkout')->with([
            'message' => 'Address created!',
            'alert-type' => 'success'
        ]);
    }

    public function formSubmit(Request $request){
        $request->validate([
            'shipping_method_id' => ['required'],
            'shipping_address_id' => ['required'],
        ]);

        $shippingRule = ShippingRule::findOrFail($request->shipping_method_id);
        $shippingAddress = UserAddress::findOrFail($request->shipping_address_id)->toArray();

        if( $shippingRule){
            Session::put('shipping_rules', [
                'id' => $shippingRule->id,
                'name' => $shippingRule->name,
                'type' => $shippingRule->cost
          ]);
        }
        
        if($shippingAddress){
            Session::put('shipping_address', $shippingAddress);
        }
        

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('user.payment')
        ]);
    }
}
