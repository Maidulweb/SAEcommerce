<?php

function setActive(array $route) {
    if(is_array($route)){
        foreach ($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

function checkDiscount($product){
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

