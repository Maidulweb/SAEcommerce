@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Order</h1>
    </div>

    <div class="section-body mb-0">
          <div class="card">
            <div class="invoice-print" id="order_print_body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
                      <h2>Invoice</h2>
                      <div class="invoice-number">Order {{$order->invoice_id}}</div>
                    </div>
                    <hr>
                    <div class="row">
                        @php
                            $address = json_decode($order->order_address);
                          
                        @endphp
                      <div class="col-md-6">
                        <address>
                          <strong>Billed To:</strong><br>
                            {{$address->name}}<br>
                            {{$address->email}}<br>
                            {{$address->phone}}<br>
                            {{$address->state}}<br>
                            {{$address->city}}<br>
                            {{$address->zip_code}}<br>
                            {{$address->address}}<br>
                            {{$address->country}}<br>
                        </address>
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Shipped To:</strong><br>
                          Muhamad Nauval Azhar<br>
                          1234 Main<br>
                          Apt. 4B<br>
                          Bogor Barat, Indonesia
                        </address>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div>
                          <h6>Payment Method:</h6>
                          <p class="mb-1">Payment Method - {{$order->payment_method}}</p>
                          <p class="mb-1">Transaction ID - {{@$order->transaction->transaction_id}}</p>
                          <p class="mb-1">Status - {{$order->payment_status}}</p>
                        </div>
                      </div>
                      <div class="col-md-6 text-md-right">
                        <div>
                          <strong>Order Date:</strong><br>
                          {{date('d-F-Y', strtotime($order->created_at))}}<br><br>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="section-title">Order Summary</div>
                    <p class="section-lead">All items here cannot be deleted.</p>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                          <th data-width="40">#</th>
                          <th>Item</th>
                          <th class="text-center">Vendor</th>
                          <th class="text-center">Unit Price</th>
                          <th class="text-center">Variants</th>
                          <th class="text-center">Quantity</th>
                          <th class="text-center">Total</th>
                        </tr>
                        @foreach ( $order->orderproduct as $item)
                        <tr>
                          <td>{{++$loop->index}}</td>
                          @if ($item->product->slug)
                          <td><a target="_blank" href="{{route('frontend.product-details.index', $item->product->slug)}}">{{$item->product_name}}</a></td>
                          @endif
                          <td class="text-center">{{$item->vendor->shop_name}}</td>
                          <td class="text-center">{{$item->unit_price}}</td>
                          @php
                            $variants = json_decode($item->product_variants);
                          @endphp
                          <td class="text-center">
                            @foreach ($variants as $key=>$variantItem)
                              <b>{{$key}}</b> - {{$variantItem->itemName}}- {{$variantItem->price}}
                            @endforeach
                          </td>
                          <td class="text-center">{{$item->qty}}</td>
                          <td class="text-center">{{($item->unit_price + $item->product_variants_total)*$item->qty}}</td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col-md-4">
                             <div class="form-group">
                              <label for=""><strong>Payment Status</strong></label>
                               <select name="payment_status" id="payment_status" data-id="{{$order->id}}" class="form-control">
                               <option {{$order->order_status === 1 ? 'selected' : ''}} value="1">Completed</option>
                               <option {{$order->order_status === 0 ? 'selected' : ''}} value="0">Pending</option>
                               </select>
                             </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                             <div class="form-group">
                              <label for=""><strong>Order Status</strong></label>
                               <select name="order_status" id="order_status" data-id="{{$order->id}}" class="form-control">
                               @foreach(config('order_status.order_status_admin') as $key=>$status)
                               <option {{$order->order_status === 'pending' ? $key : ''}} value="{{$key}}">{{$status['status']}}</option>
                               @endforeach
                               </select>
                             </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 text-right mt-4">
                        <div class="invoice-detail-item mt-1">
                          @php
                          $coupon = json_decode($order->coupon);
                          @endphp
                          <div class="invoice-detail-value"><strong>Subtotal : {{$setting->currency_icon}}{{$order->sub_total}}</strong></div>
                        </div>
                        <div class="invoice-detail-item mt-1">
                         
                          <div class="invoice-detail-value"><strong>Coupon : (-){{$setting->currency_icon}}{{@$coupon->discount ? $coupon->discount : 0}}</strong></div>
                        </div>
                        <div class="invoice-detail-item mt-1">
                          @php
                          $shipping = json_decode($order->shipping_rules);
                          @endphp
                          <div class="invoice-detail-value"><strong>Shipping Fee : (+){{$setting->currency_icon}}{{@$shipping->cost ? $shipping->cost : 0}}</strong></div>
                        </div>
                        <div class="invoice-detail-item mt-1">
                          <div class="invoice-detail-value invoice-detail-value-lg"><strong>Total : {{$setting->currency_icon}}{{$order->amount}}</strong></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-md-right">
                <button id="order_print" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
              </div>
          </div>
    </div>
  </section>
  
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){
      $('#order_status').on('change', function(){
        let status = $(this).val();
        let id = $(this).data('id');
        $.ajax({
          method:'GET',
          url:"{{route('admin.order.status')}}",
          data:{
            status:status,
            id:id
          },
          success:function(data){
            if(data.status === 200){
              toastr.success(data.message);
            }
          },
          error:function(error){
            console.log(error)
          }
          
        })
      })

      $('#payment_status').on('change', function(){
        let payment_status = $(this).val();
        let id = $(this).data('id');
        $.ajax({
          method:'GET',
          url:"{{route('admin.order.payment.status')}}",
          data:{
            payment_status:payment_status,
            id:id
          },
          success:function(data){
            if(data.status === 200){
              toastr.success(data.message);
            }
          },
          error:function(error){
            console.log(error)
          }
          
        })
      })

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

