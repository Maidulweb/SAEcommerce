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
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="#">pages</a></li>
                            <li><a href="#">Flash Sale</a></li>
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
        DAILY DEALS DETAILS START
    ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{asset('frontend/images/offer_banner_2.png')}}" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{asset('frontend/images/offer_banner_3.png')}}" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($flashSaleItems as $flashSaleItem)
                    @php
                        $product = \App\Models\Product::find($flashSaleItem->product_id);
                    @endphp
                    <div class="col-xl-3 col-sm-6 col-lg-4">
                        <div class="wsus__product_item">
                            <span class="wsus__new">{{ productType($product) }}</span>
                            @if (checkOffer($product))
                                <span
                                    class="wsus__minus">-{{ checkDiscountPercentage($product->price, $product->offer_price) }}%</span>
                            @endif
                            <a class="wsus__pro_link"
                                href="{{ route('frontend.product-details.index', $product->slug) }}">
                                <img src="{{ asset($product->thumb_image) }}" alt="product"
                                    class="img-fluid w-100 img_1" />
                                <img src="
                        @if (isset($product->productImagegallery[0]->images)) {{ asset($product->productImagegallery[0]->images) }}
                        @else
                        {{ asset($product->thumb_image) }} @endif
                        "
                                    alt="product" class="img-fluid w-100 img_2" />
                            </a>
                            <ul class="wsus__single_pro_icon">
                                <li><a class="modal-data" href="#" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal-{{ $product->id }}"><i
                                            class="far fa-eye"></i></a></li>
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="far fa-random"></i></a>
                            </ul>
                            <div class="wsus__product_details">
                                <a class="wsus__category" href="{{route('frontend.product-details.index', $product->slug)}}">{{ $product->category->name }} </a>
                                <p class="wsus__pro_rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>(133 review)</span>
                                </p>
                                <a class="wsus__pro_name"
                                    href="{{ route('frontend.product-details.index', $product->slug) }}">{{ $product->name }}</a>
                                @if (checkOffer($product))
                                    <p class="wsus__price">{{ $setting->currency_icon }}{{ $product->offer_price }}
                                        <del>{{ $setting->currency_icon }}{{ $product->price }}</del>
                                    </p>
                                @else
                                    <p class="wsus__price">{{ $setting->currency_icon }}{{ $product->price }}</p>
                                @endif
                                <form class="shopping-cart-form">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <select class="d-none" name="variants[]">
                                        @foreach ($product->productVariant as $productVariant)
                                            @foreach ($productVariant->productVariantItem as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>

                                    <input name="qty" type="hidden" min="1" max="100" value="1" />

                                    <button class="add_cart" type="submit">add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="mt-4">
                    @if ($flashSaleItems->hasPages())
                        {{$flashSaleItems->links()}}
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--============================
        DAILY DEALS DETAILS END
    ==============================-->
    @include('frontend.layouts.modal')
@endsection

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