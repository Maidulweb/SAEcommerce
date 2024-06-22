@extends('vendor.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
              <!--============================
        INVOICE PAGE START
    ==============================-->
    
        <div class="container">
            <div class="wsus__invoice_area">
                <div class="wsus__invoice_header">
                   <div id="order_print_body">
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
                                @if ($product->vendor_id === Auth::user()->vendor->id)
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
                                        {{$setting->currency_icon}}{{$product->unit_price * $product->qty}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                   </div>
                    <div class="row">
                        <div class="col-md-4">
                            <form action="{{route('vendor.order.status', $order->id)}}" method="post">
                             @csrf
                             <div class="form-group">
                                 <label for="">Order Status</label>
                                 <select class="form-control" name="order_status">
                                     @foreach (config('order_status.vendor_order_status') as $key=>$item)
                                         <option {{$order->order_status === $key ? 'selected' : ''}} value="{{$key}}">{{$item['status']}}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <button type="submit" class="btn btn-primary mt-2">Save</button>
                            </form>
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

        $('body').html(print_section.html());
        
        window.print();

        $('body').html(bodyHtml);

        })
    })
  </script>
@endpush

