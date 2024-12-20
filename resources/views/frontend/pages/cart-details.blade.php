@extends('frontend.layouts.master')
@section('title')
{{$setting->site_name}} - Cart Details
@endsection
@section('content')
 <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
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
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_status">
                                           total price
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                       {{-- <th class="wsus__pro_tk">
                                           Total price
                                        </th> --}}

                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn cart-clear">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItems as $item)
                                    <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="{{asset($item->options->image)}}" alt="product"
                                                class="img-fluid w-100">
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>{{$item->name}}({{$setting->currency_icon.$item->price}})</p>
                                            @foreach ($item->options->variants as $key=>$itemName)
                                            <span>{{$key}}: {{$itemName['itemName']}}({{$setting->currency_icon.$itemName['price']}})</span>   
                                            @endforeach
                                          
                                        </td>

                                        <td class="wsus__pro_status">
                                        @if ($item->options->variant_item_price)
                                        <p id="{{$item->rowId}}">{{$setting->currency_icon}}{{($item->options->variant_item_price + $item->price) * $item->qty}}</p>
                                        @else
                                            <p id="{{$item->rowId}}">{{$setting->currency_icon}}{{$item->price * $item->qty}}</p>
                                        @endif
                                        </td>

                                        <td class="wsus__pro_select">
                                            <div class="d-flex">
                                                <button class="minus-qty btn btn-primary">-</button>
                                                <input class="input-qty" type="text" min="1" max="100" data-id="{{$item->rowId}}" value="{{$item->qty}}" />
                                                <button class="add-qty btn btn-primary">+</button>
                                            </div>
                                        </td>

                                        <td class="wsus__pro_icon">
                                            <a href="{{route('cart.remove', $item->rowId)}}"><i class="far fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                  
                                </tbody>
                            </table>
                            @if(count($cartItems) === 0)
                            <div class="text-center p-4">
                                <h3 class="text-danger">No item</h3>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span id="sub_total">{{$setting->currency_icon}}{{getCartTotal()}}</span></p>
                        <p>discount: <span id="calculate_discount">{{getDiscount()}}</span></p>
                        <form id="coupon_apply">
                            <input type="text" name="coupon_code" placeholder="Coupon Code" value="{{Session::has('coupon')?Session::get('coupon')['coupon_code']:''}}">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <p class="total"><span>total:</span> <span id="calculate_cart_total">{{getMainCartTotal()}}</span></p>

                        
                        <a class="common_btn mt-4 w-100 text-center" href="{{route('user.checkout')}}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                class="fab fa-shopify"></i> go shop</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="{{asset('frontend/images/single_banner_2.jpg')}}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="{{asset('frontend/images/single_banner_3.jpg')}}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          CART VIEW PAGE END
    ==============================-->
@endsection

@push('scripts')
    <script>
      $(document).ready(function(){
        $('.add-qty').on('click', function(){
            let inputValue = $(this).siblings('.input-qty');
            let quantity = parseInt(inputValue.val()) + 1;
            inputValue.val(quantity);
            let rowId =  inputValue.data('id');
            $.ajax({
                method:'POST',
                url:'{{route("cart-quantity-update")}}',
                data:{
                    quantity:quantity,
                    rowId:rowId
                },
                success:function(data){
                    if(data.status === 200){
                        let id = '#'+rowId;
                        $(id).text("{{$setting->currency_icon}}"+data.total);
                        renderCartSubTotal();
                        couponCalculationTotal();
                        toastr.success(data.message)
                    }else if(data.status === 'error'){
                        toastr.error(data.message)
                    }
                    
                    
                },
                error:function(error){
                   console.log(error)
                }
            })
            
        })

        $('.minus-qty').on('click', function(){
            let inputValue = $(this).siblings('.input-qty');
            let quantity = parseInt(inputValue.val()) - 1;
            if(quantity < 1){
                quantity = 1
            }
            inputValue.val(quantity);
            let rowId =  inputValue.data('id');
            $.ajax({
                method:'POST',
                url:'{{route("cart-quantity-update")}}',
                data:{
                    quantity:quantity,
                    rowId:rowId
                },
                success:function(data){
                    if(data.status === 200){
                        let id = '#'+rowId;
                        $(id).text(data.total);
                        renderCartSubTotal();
                        couponCalculationTotal();
                        toastr.success(data.message)
                    }
                    
                    
                },
                error:function(error){
                   console.log(error)
                }
            })
            
        })
        
        $('.cart-clear').on('click', function(event){
            event.preventDefault();
            Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to clear all!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, clear all!"
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  method:'GET',
                  url:"{{route('cart.clear')}}",
                  success:function(data){
                    if(data.status=='success'){
                    window.location.reload()
                    }
                  },
                  error:function(xhr,status,error){
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                  }
                })
              }
           });
        })

       //Render total

       function renderCartSubTotal(){
                $.ajax({
                    method: 'GET',
                    url: '{{ route('cart.sidebar-product.total') }}',
                    success: function(data) {
                        $('#sub_total').text("{{ $setting->currency_icon }}" + data);
                    },
                    error: function() {
                    }
                })
       }

       $('#coupon_apply').on('submit', function(e){
        e.preventDefault();
        let formData = $(this).serialize();
            $.ajax({
                method: 'GET',
                url: '{{ route('coupon-apply') }}',
                data:formData,
                success: function(data) {
                   if(data.status === 401){
                    toastr.error(data.message);
                   }else if(data.status === 402){
                    toastr.error(data.message);
                   }else if(data.status === 403){
                    toastr.error(data.message);
                   }else if(data.status === 404){
                    toastr.error(data.message);
                   }
                   
                   if(data.status === 200){
                    couponCalculationTotal();
                    toastr.success(data.message);
                   }
                   
                },
                error: function(error) {
                    console.log(error)
                }
            })
       })

       function couponCalculationTotal(){
                $.ajax({
                    method: 'GET',
                    url: '{{ route('coupon-calculation') }}',
                    success: function(data) {
                        $('#calculate_discount').text(data.discount);
                        $('#calculate_cart_total').text(data.cart_total);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
       }

      })
    </script>
@endpush