    <!--==========================
      PRODUCT MODAL VIEW START
    ===========================-->
    @include('frontend.layouts.modal')
    <!--==========================
      PRODUCT MODAL VIEW END
    ===========================-->
<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{asset('frontend/images/flash_sell_bg.jpg')}})">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sell</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{route('pages.flash-sale.index')}}">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($flashSaleItems as $flashSaleItem)
            @php
                $product = \App\Models\Product::find($flashSaleItem->product_id);
            @endphp
            <div class="col-xl-3 col-sm-6 col-lg-4">
                <div class="wsus__product_item">
                    <span class="wsus__new">{{productType($product)}}</span>
                    @if(checkOffer($product))
                    <span class="wsus__minus">-{{checkDiscountPercentage($product->price,$product->offer_price)}}%</span>
                    @endif
                    <a class="wsus__pro_link" href="{{route('frontend.product-details.index', $product->slug)}}">
                        <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100 img_1" />
                        <img src="
                        @if(isset($product->productImagegallery[0]->images))
                        {{asset($product->productImagegallery[0]->images)}}
                        @else
                        {{asset($product->thumb_image)}}
                        @endif
                        " alt="product" class="img-fluid w-100 img_2" /> 
                    </a>
                    <ul class="wsus__single_pro_icon">
                        <li><a class="modal-data" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$product->id}}"><i
                                    class="far fa-eye"></i></a></li>
                        <li><a href="#"><i class="far fa-heart"></i></a></li>
                        <li><a href="#"><i class="far fa-random"></i></a>
                    </ul>
                    <div class="wsus__product_details">
                        <a class="wsus__category" href="#">{{$product->category->name}} </a>
                        <p class="wsus__pro_rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(133 review)</span>
                        </p>
                        <a class="wsus__pro_name" href="{{route('frontend.product-details.index', $product->slug)}}">{{$product->name}}</a>
                        @if(checkOffer($product))
                        <p class="wsus__price">{{$setting->currency_icon}}{{$product->offer_price}} <del>{{$setting->currency_icon}}{{$product->price}}</del></p>
                        @else
                        <p class="wsus__price">{{$setting->currency_icon}}{{$product->price}}</p>
                        @endif
                        <a class="add_cart" href="#">add to cart</a>
                    </div>
                </div>
            </div> 
            @endforeach
        </div>
    </div>
</section>
@push('scripts')
    <script>
        $(document).ready(function(){
            simplyCountdown('.simply-countdown-one', {
            year: {{date('Y', strtotime($flashSaleDate->flash_sale_end_date))}},
            month: {{date('m', strtotime($flashSaleDate->flash_sale_end_date))}},
            day: {{date('d', strtotime($flashSaleDate->flash_sale_end_date))}},
            });
        })
    </script>
@endpush