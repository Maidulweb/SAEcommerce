@extends('frontend.dashboard.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
              <!--============================
        INVOICE PAGE START
    ==============================-->
        <div class="container" id="order_print_body">
            <div class="wsus__invoice_area">
                <div class="wsus__invoice_header">
                   <div>
                    <div class="wsus__invoice_content">
                        <div class="row">
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single">
                                    @php
                                        $address = json_decode($order->order_address);
                                    @endphp
                                    <h6>{{$address->name}}</h6>
                                    <h6>{{$address->email}}</h6>
                                    <h6>{{$address->phone}}</h6>
                                    <h6>{{$address->phone}}</h6>
                                    <span>{{$address->address}}</span>
                                    <span>, {{$address->state}}</span>
                                    <span>, {{$address->city}}</span>
                                    <span>, {{$address->zip_code}}</span>
                                    
                                    <span>, {{$address->country}}</span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single text-md-center">
                                    <h6>{{$address->name}}</h6>
                                    <h6>{{$address->email}}</h6>
                                    <h6>{{$address->phone}}</h6>
                                    <h6>{{$address->phone}}</h6>
                                    <span>{{$address->address}}</span>
                                    <span>, {{$address->state}}</span>
                                    <span>, {{$address->city}}</span>
                                    <span>, {{$address->zip_code}}</span>
                                    
                                    <span>, {{$address->country}}</span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="wsus__invoice_single text-md-end">
                                    <h5>Order ID: {{$order->invoice_id}}</h5>
                                    <h6>Order Status: {{$order->order_status}}</h6>
                                    <p>Payment Method: {{$order->payment_method}}</p>
                                    <p>Payment Status: {{$order->payment_status}}</p>
                                    <p>Transaction ID: {{$order->transaction->transaction_id}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wsus__invoice_description">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="images">
                                        images
                                    </th>

                                    <th class="name">
                                        product
                                    </th>

                                    <th class="amount">
                                        amount
                                    </th>

                                    <th class="quentity">
                                        quentity
                                    </th>
                                    <th class="total">
                                        total
                                    </th>
                                </tr>
                                @foreach ($order->orderProduct as $product)
                               
                                <tr>
                                    <td class="images">
                                        <img src="{{asset($product->product->thumb_image)}}" alt="bag" class="img-fluid w-100">
                                    </td>

                                    <td class="name">
                                        <p>Product Name: {{$product->product_name}}</p>
                                        <p>Shop Name: {{$product->vendor->shop_name}}</p>
                                        @php
                                            $variants = json_decode($product->product_variants);
                                        @endphp
                                        @foreach ($variants as $key => $variant)
                                        <span>{{$key}} : {{$variant->itemName}} ({{$setting->currency_icon}}{{$variant->price}})</span>
                                        @endforeach
                                        
                                    </td>
                                    <td class="amount">
                                        {{$setting->currency_icon}}{{$product->unit_price}}
                                    </td>

                                    <td class="quentity">
                                       {{$product->qty}}
                                    </td>
                                    <td class="total">
                                        @php
                                            $variants = json_decode($product->product_variants);
                                            $variantTotal = 0;
                                        @endphp
                                        @foreach ($variants as $variant)
                                        @php
                                         $variantTotal += $variant->price 
                                        @endphp
                                          
                                        @endforeach
                                        {{$setting->currency_icon}}{{($product->unit_price + $variantTotal) * $product->qty}}
                                    </td>
                                </tr>
                               
                                @endforeach
                            </table>
                        </div>
                    </div>
                   </div>
                    <div class="row">
                        
                         <div class="col-md-4">
                            <p>Sub Total : {{$order->sub_total}}</p>
                            @php
                                $coupon = json_decode($order->coupon);
                                $shipping = json_decode($order->shipping_rules);
                            @endphp
                            <p>Coupon(-) : {{$coupon->discount}}</p>
                            <p>Shipping Fee(+) : {{$shipping->cost}}</p>
                            <p>Total : {{$order->amount}}</p>
                         </div>
                         <div class="col-md-4"></div>
                         <div class="col-md-4"><button class="btn btn-info mt-5" type="button" id="order_print">Print</button></div>
                    </div>
                </div>
            </div>
        </div>
    <!--============================
        INVOICE PAGE END
    ==============================-->
    </div>
  </div>

  
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){
      $('#order_print').on('click', function(){
        let print_section = $('#order_print_body');
        let bodyHtml = $('body').html();
        $(this).addClass('d-none');

        $('body').html(print_section.html());
        
        window.print();

        $('body').html(bodyHtml);

        })
    })
  </script>
@endpush

