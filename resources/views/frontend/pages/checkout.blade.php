@extends('frontend.layouts.master')
@section('content')
<!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>check out</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">check out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CHECK OUT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Billing Details <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                    new address</a></h5>
                          
                            <div class="row">
                                @foreach ($userAddresses as $userAddress)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_address" type="radio" name="flexRadioDefault"
                                                data-id="{{$userAddress->id}}">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Select Address
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Name :</span>{{$userAddress->name}}</li>
                                            <li><span>Phone :</span> {{$userAddress->phone}}</li>
                                            <li><span>Email :</span> {{$userAddress->email}}</li>
                                            <li><span>Country :</span> {{$userAddress->country}}</li>
                                            <li><span>State :</span> {{$userAddress->state}}</li>
                                            <li><span>City :</span> {{$userAddress->city}}</li>
                                            <li><span>Zip Code :</span> {{$userAddress->zip_code}}</li>
                                            <li><span>Address :</span> {{$userAddress->address}}</li>
                                        </ul>
                                    </div>
                                </div> 
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">shipping Methods</p>
                            @foreach ($shippingRules as $shippingRule)
                            @if ($shippingRule->type === 'min_cost' && getCartTotal() >= $shippingRule->min_cost)
                               <div class="form-check">
                                <input class="form-check-input shipping_method" type="radio" name="test" id="test"
                                    value="{{$shippingRule->id}}" data-id="{{$shippingRule->cost}}">
                                <label class="form-check-label" for="test">
                                    {{$shippingRule->name}}
                                    <span>Cost: {{$shippingRule->cost}}</span>
                                </label>
                            </div>
                            @elseif ($shippingRule->type === 'flat_cost')
                            <div class="form-check">
                                <input class="form-check-input shipping_method" type="radio" name="test" id="test"
                                    value="{{$shippingRule->id}}" data-id="{{$shippingRule->cost}}">
                                <label class="form-check-label" for="test">
                                    {{$shippingRule->name}}
                                     <span>Cost: {{$setting->currency_icon}}{{$shippingRule->cost}}</span>
                                </label>
                            </div>
                            @endif
                                
                            @endforeach
                            <div class="wsus__order_details_summery">
                                <p>subtotal: <span>{{$setting->currency_icon}}{{getCartTotal()}}</span></p>
                                <p>shipping fee: <span id="shipping_fee">{{$setting->currency_icon}}0</span></p>
                                <p>Coupon(-): <span>{{$setting->currency_icon}}{{getDiscount()}}</span></p>
                                
                                <p><b>total:</b> <span><b id="total_amount" data-id="{{getMainCartTotal()}}">{{$setting->currency_icon}}{{getMainCartTotal()}}</b></span></p>
                            </div>
                            <div class="terms_area">
                                <div class="form-check">
                                    <input class="form-check-input checkoout-terms-condition" type="checkbox" id="flexCheckChecked3"
                                        >
                                    <label class="form-check-label" for="flexCheckChecked3">
                                        I have read and agree to the website <a href="#">terms and conditions *</a>
                                    </label>
                                </div>
                            </div>
                            <form action="" id="checkOutForm">
                                <input type="hidden" name="shipping_method_id"  id="shipping_method_id" value="">
                                <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="" >
                            </form>
                            <a href="" id="submitCheckOutForm" class="common_btn">Place Order</a>
                        </div>
                    </div>
                </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <div class="row">
                                <form action="{{route('user.checkout.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                      <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                          <label>name <b>*</b></label>
                                          <input type="text" name="name" value="{{old('name')}}" placeholder="Name">
                                        </div>
                                      </div>
                                      <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                          <label>email</label>
                                          <input type="email" name="email" value="{{old('email')}}"  placeholder="Email">
                                        </div>
                                      </div>
                                      <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                          <label>phone <b>*</b></label>
                                          <input type="text" name="phone" value="{{old('phone')}}"  placeholder="Phone">
                                        </div>
                                      </div>
                                      <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                          <label>countery <b>*</b></label>
                                          <div class="wsus__topbar_select">
                                            <select class="select_2" name="country">
                                              @foreach (config('setting.country_lists') as $country)
                                              <option value="{{$country}}">{{$country}}</option>
                                              @endforeach  
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                          <label>state <b>*</b></label>
                                          <input type="text" name="state" value="{{old('state')}}"  placeholder="State">
                                        </div>
                                      </div>
                                      <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                          <label>city <b>*</b></label>
                                          <input type="text" name="city" value="{{old('city')}}"  placeholder="City">
                                        </div>
                                      </div>
                                      <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                          <label>zip code <b>*</b></label>
                                          <input type="text" name="zip_code" value="{{old('zip_code')}}"  placeholder="Zip Code">
                                        </div>
                                      </div>
                                      <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                          <label>address <b>*</b></label>
                                          <input type="text" name="address" value="{{old('address')}}"  placeholder="Address">
                                        </div>
                                      </div>
                                      <div class="col-xl-6">
                                        <button type="submit" class="common_btn">Create Address</button>
                                      </div>
                                    </div>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============================
        CHECK OUT PAGE END
    ==============================-->
@endsection
 
@push('scripts')
<script>
    $(document).ready(function(){
        $('.shipping_method').on('click', function(){
            $('#shipping_method_id').val($(this).val());
            $('#shipping_fee').text("{{$setting->currency_icon}}"+$(this).data('id'))
            
           let result = $('#total_amount').text("{{$setting->currency_icon}}"+($('#total_amount').data('id')+$(this).data('id')));

           console.log($result);
        })

        $('.shipping_address').on('click', function(){
            $('#shipping_address_id').val($(this).data('id')) 
        })

        $('#submitCheckOutForm').on('click', function(e){
            e.preventDefault();
             if($('#shipping_method_id').val() == ""){
                toastr.error('Shipping method is required!')
             }else if($('#shipping_address_id').val() == ""){
                toastr.error('Shipping address is required!')
             }else if(!$('.checkoout-terms-condition').prop('checked')){
                toastr.error('Agree terms and conditions!!!')
             }else{
                $.ajax({
                method:'POST',
                url:'{{route('user.checkout.form-submit')}}',
                data:$('#checkOutForm').serialize(),
                beforeSend:function(){
                 $('#submitCheckOutForm').html('<i class="fa fas fa-spinner fa-spin fa-1x"></i>')
                },
                success:function(data){
                   if(data.status == 'success'){
                    $('#submitCheckOutForm').text('Place Order');
                    window.location.href = data.redirect_url;
                   }
                },
                error:function(error){
                  console.log(error);
                }
             })
             } 
        })
    })
</script>
    
@endpush