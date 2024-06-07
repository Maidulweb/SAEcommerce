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
                                            <a href="#" class="common_btn">clear cart</a>
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
                                        <p id="{{$item->rowId}}">{{$setting->currency_icon}}{{$item->options->variant_item_price + $item->price}}</p>
                                        @else
                                            <p id="{{$item->rowId}}">{{$setting->currency_icon}}{{$item->price}}</p>
                                        @endif
                                        </td>

                                        <td class="wsus__pro_select">
                                            <div class="d-flex">
                                                <button class="minus-qty btn btn-primary">-</button>
                                                <input class="input-qty" type="text" min="1" max="100" data-id="{{$item->rowId}}" value="{{$item->qty}}" />
                                                <button class="add-qty btn btn-primary">+</button>
                                            </div>
                                        </td>

                                        <td class="wsus__pro_tk">
                                            <h6>Total Price</h6>
                                        </td>

                                        <td class="wsus__pro_icon">
                                            <a href="#"><i class="far fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span>$124.00</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span> <span>$134.00</span></p>

                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="check_out.html">checkout</a>
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
                        $(id).text(data.total);
                        toastr.success(data.message)
                    }
                    
                    
                },
                error:function(error){
                   console.log(error)
                }
            })
        })
/* 
        $('.minus-qty').on('click', function(){
            let inputValue = $(this).siblings('.input-qty');
            let quantity = parseInt(inputValue.val()) - 1;
            inputValue.val(quantity);
            console.log(quantity);
        }) */
      })
    </script>
@endpush