<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cod;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Stripe;
use Str;

class PaymentController extends Controller
{
    public function index(){
              if(!Session::has('shipping_address')){
                return redirect()->route('user.checkout');
              }
              return view('frontend.pages.payment');
    }

    public function paymentSuccess(){
      
             return view('frontend.pages.payment-success');
    }

    public function paypalConfig(){
              $paypalSetting = PaypalSetting::first();

              $config = [
                  'mode'    => $paypalSetting->mode === 1 ? 'live' : 'sandbox',
                  'sandbox' => [
                      'client_id'         => $paypalSetting->client_id,
                      'client_secret'     => $paypalSetting->secret_key,
                      'app_id'            => '',
                  ],
                  'live' => [
                      'client_id'         => $paypalSetting->client_id,
                      'client_secret'     => $paypalSetting->secret_key,
                      'app_id'            => '',
                  ],
              
                  'payment_action' => 'Sale',
                  'currency'       => $paypalSetting->currency_name,
                  'notify_url'     => '',
                  'locale'         => 'en_US',
                  'validate_ssl'   => true,
              ];
              return $config; 
    }

    public function paypal(){
              $config = $this->paypalConfig();
              $paypalSetting = PaypalSetting::first();
              $provider = new PayPalClient($config);
              $provider->getAccessToken();

              $total = getFinalPay();

              $payAbleAmount = round($total*$paypalSetting->currency_rate, 2);

              $response = $provider->createOrder([
                    "intent"=> "CAPTURE",
                    "application_context"=> [
                        "return_url" => route('user.paypal.payment.success'),
                        "cancel_url" => route('user.paypal.payment.cancel'),
                    ],
                    "purchase_units"=> [
                      [
                        "amount"=> [
                          "currency_code"=> $config['currency'],
                          "value"=> $payAbleAmount
                        ]
                      ]
                    ]
                ]);

            if(isset($response['id']) && $response['id'] != null){
                foreach($response['links'] as $link){
                    if($link['rel'] === 'approve'){
                      return redirect()->away($link['href']);
                    }    
                }
            }else{
              return redirect()->route('user.paypal.payment.cancel');
            }
    }

    public function storeOrder($paymentMethod,$paymentStatus,$transactionId,$realCurrency,$realCurrencyName){
          $generalSetting = GeneralSetting::first(); 
          $storeOrder = new Order();
          $storeOrder->invoice_id = rand(1, 999999);
          $storeOrder->user_id = Auth::user()->id;
          $storeOrder->sub_total = getCartTotal();
          $storeOrder->amount = getFinalPay();
          $storeOrder->currency_name = $generalSetting->currency_name;
          $storeOrder->currency_icon = $generalSetting->currency_icon;
          $storeOrder->product_qty = \Cart::content()->count();
          $storeOrder->payment_method = $paymentMethod;
          $storeOrder->payment_status = $paymentStatus;
          $storeOrder->order_address = json_encode(Session::get('shipping_address'));
          $storeOrder->shipping_rules = json_encode(Session::get('shipping_rules'));
          $storeOrder->coupon = json_encode(Session::get('coupon'));
          $storeOrder->order_status = 'pending';
          $storeOrder->save();

          foreach(\Cart::content() as $cartItem){
            $product = Product::find($cartItem->id);
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $storeOrder->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->product_name = $product->name;
            $orderProduct->product_variants = json_encode($cartItem->options->variants);
            $orderProduct->product_variants_total = $cartItem->options->variant_item_price;
            $orderProduct->unit_price = $cartItem->price;
            $orderProduct->qty = $cartItem->qty;
            $orderProduct->save();

            /* Upadate Quantity */
            $updateQty = ($product->qty - $cartItem->qty);
            $product->qty = $updateQty;
            $product->save();
          }
          
          $transaction = new Transaction();
          $transaction->order_id = $storeOrder->id;
          $transaction->transaction_id = $transactionId;
          $transaction->payment_method = $paymentMethod;
          $transaction->amount = getFinalPay();
          $transaction->amount_real_currency = $realCurrency;
          $transaction->amount_real_currency_name = $realCurrencyName;
          $transaction->save();
    }
    
    public function clearSession(){
      \Cart::destroy();
      Session::forget('coupon');
      Session::forget('shipping_address');
      Session::forget('shipping_rules');
    }

    public function paypalSuccess(Request $request){
      $config = $this->paypalConfig();
      $provider = new PayPalClient($config);
      $provider->getAccessToken();

      $response = $provider->capturePaymentOrder($request->token);
      if(isset($response['status']) && $response['status'] === 'COMPLETED'){
        //Store data
        $paypalSetting = PaypalSetting::first();
        $total = getFinalPay();
        $payAbleAmount = round($total*$paypalSetting->currency_rate, 2);

        $this->storeOrder('Paypal',1,$response['id'],$payAbleAmount,$paypalSetting->currency_name);
        //Clear session
        $this->clearSession();
        return redirect()->route('user.payment.success')->with([
          'message' => 'Payment successfully',
          'alert-type' => 'success'
        ]);
      }

      return redirect()->route('user.paypal.payment.cancel');
    }

    public function paypalCancel(){
      return redirect()->route('user.payment')->with([
        'status' => 'error',
        'message' => 'Something wrong!!!'
      ]);
    }

   public function stripe(Request $request){
    $stripeSetting = StripeSetting::first();
    $total = getFinalPay();
    $payAbleAmount = round($total*$stripeSetting->currency_rate, 2);
    Stripe::setApiKey($stripeSetting->secret_key);
    $response = Charge::create([
      'amount' => $payAbleAmount * 100,
      'currency' => $stripeSetting->currency_name,
      'source' => $request->token,
      'description' => 'Payment test',
    ]);
    if($response->status =='succeeded'){
      $this->storeOrder('Stripe',$response->status,$response->id, $payAbleAmount,$stripeSetting->currency_name);
         //Clear session
         $this->clearSession();
         return redirect()->route('user.payment.success')->with([
           'message' => 'Payment successfully',
           'alert-type' => 'success'
         ]);
    } else {
      return redirect()->route('user.payment')->with([
        'status' => 'error',
        'message' => 'Something wrong!!!'
      ]);
    }
   } 

   public function stripeSuccess(){
    return view('frontend.pages.payment-success');
   }

   public function cod(Request $request){

    $cod = Cod::first();
    $total = getFinalPay();
    $payAbleAmount = round($total, 2);
    
 
   
      $this->storeOrder('COD',1,\Str::random(10), $payAbleAmount,'$');
         //Clear session
         $this->clearSession();
         return redirect()->route('user.payment.success')->with([
           'message' => 'Payment successfully',
           'alert-type' => 'success'
         ]);
    
   }
}
