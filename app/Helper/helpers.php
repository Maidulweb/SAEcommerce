<?php

use Illuminate\Support\Facades\Session;

function setActive(array $route) {
    if(is_array($route)){
        foreach ($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

function checkOffer($product){
    $currentDate = date('Y-m-d');
    if($product->offer_price > 0 && $product->offer_start_date <= $currentDate && $product->offer_end_date >= $currentDate){
      return true;
    }
    return false;
}

function checkDiscountPercentage($originalPrice, $offerPrice){
   $discount = $originalPrice - $offerPrice;
   $discountPercentage = ($discount / $originalPrice) * 100;
   return $discountPercentage;
}

function productType($product){
  switch ($product->product_type){
    case 'top_product':
        return 'Top';
        break;
    case 'new_product':
        return 'New';
        break;
    case 'featured_product':
        return 'Featured';
        break;
    case 'best_product':
        return 'Best';
        break;
    default:
    return '';    
  }
}

function getCartTotal(){
    $total = 0;
      foreach(\Cart::content() as $product){
           $total += ($product->price + $product->options->variant_item_price) * $product->qty;
      }
      return $total;
  }

function getMainCartTotal(){
    if(Session::has('coupon')){

        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();

        if($coupon['discount_type'] == 'amount'){
          $total = $subTotal - $coupon['discount'];
          return $total;
        }else if($coupon['discount_type'] == 'percentage'){
          $total = $subTotal - $subTotal * $coupon['discount'] / 100;
          return $total;
        }
      }else {
        return getCartTotal();
      }
}

function getDiscount(){
    if(Session::has('coupon')){

        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();

        if($coupon['discount_type'] == 'amount'){
          return $coupon['discount'];
        }else if($coupon['discount_type'] == 'percentage'){
            $discount = $subTotal * $coupon['discount'] / 100;
          return $discount;
        }
      }else {
        return 0;
      }
}

function getShippingFee(){
  if(Session::has('shipping_fee')){
    return Session::get('shipping_fee')['cost'];
  }else{
    return 0;
  }
}

function getFinalPay(){
  return getMainCartTotal() + getShippingFee();
}



