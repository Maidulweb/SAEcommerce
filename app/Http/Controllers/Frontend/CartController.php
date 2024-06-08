<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function addToCart(Request $request){

       $product = Product::findOrFail($request->product_id);

       $variants = [];
       $variantItemPrice = 0;

       if($request->has('variants')){
         foreach($request->variants as $item){
               $productVariantItem = ProductVariantItem::findOrFail($item);
   
               /* $variants[$productVariantItem->productVariant->name]['itemName'] = $productVariantItem->name;
               $variants[$productVariantItem->productVariant->name]['price'] = $productVariantItem->price; */
               
               $variantItem = [
               'itemName' =>$productVariantItem->name,
               'price' =>$productVariantItem->price
            ];
               $variants[$productVariantItem->productVariant->name] = $variantItem;
               $variantItemPrice += $productVariantItem->price;
            }
        
        }

        $productPrice = 0;
        if(checkOffer($product)){
         $productPrice += $product->offer_price;
        }else{
         $productPrice += $product->price;
        }

 
   

       /* Cart::add(['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'weight' => 550, 'options' => ['size' => ['name' => 'large','price' => '324']]]); */
       $cartData = [];
       $cartData['id'] = $product->id;
       $cartData['name'] = $product->name;
       $cartData['qty'] = $request->qty;
      
     
       $cartData['price'] = $productPrice;
       $cartData['weight'] = 10;
       $cartData['options']['variants'] = $variants;
       $cartData['options']['variant_item_price'] = $variantItemPrice;
       $cartData['options']['image'] = $product->thumb_image;
       $cartData['options']['slug'] = $product->slug;

      $data =  Cart::add($cartData);
       return response()->json([
        'message' => 'Added to cart',
        'alert-type' => 'success'
       ]);
    }

    public function cartDetails(){
      $cartItems = Cart::content();
      return view('frontend.pages.cart-details', compact('cartItems'));
    }

    public function cartQuantityUpdate(Request $request){
      Cart::update($request->rowId, $request->quantity); 
      $total = $this->getTotal($request->rowId);
      return response()->json([
         'message' => 'Quantity Changed',
         'alert-type' => 'success',
         'status' => 200,
         'total' => $total
        ]);
    }

    public function getTotal($rowId){
      $item = Cart::get($rowId);
      $total = ($item->price + $item->options->variant_item_price) * $item->qty;
      return $total;
     }

    public function cartClear(){
      Cart::destroy();
      return response()->json([
         'message' => 'Cart Clear',
         'status' => 'success',
        ]);
    } 
}
