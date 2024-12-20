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
                        <h4>products</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">product</a></li>
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
        PRODUCT PAGE START
    ==============================-->
    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_page_bammer">
                        <img src="{{asset('frontend/images/pro_banner_1.jpg')}}" alt="banner" class="img-fluid w-100">
                        <div class="wsus__pro_page_bammer_text">
                            <div class="wsus__pro_page_bammer_text_center">
                                <p>up to <span>70% off</span></p>
                                <h5>wemen's jeans Collection</h5>
                                <h3>fashion for wemen's</h3>
                                <a href="#" class="add_cart">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="wsus__sidebar_filter ">
                        <p>filter</p>
                        <span class="wsus__filter_icon">
                            <i class="far fa-minus" id="minus"></i>
                            <i class="far fa-plus" id="plus"></i>
                        </span>
                    </div>
                    <div class="wsus__product_sidebar" id="sticky_sidebar">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        All Categories
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($categories as $category)
                                            <li><a href="{{route('frontend.products', ['category' => $category->slug])}}">{{$category->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Price
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="price_ranger">
                                            <form action="{{url()->current()}}">
                                                @foreach (request()->query() as $key => $value)
                                                    @if ($key != 'range')
                                                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                                                    @endif
                                                @endforeach
                                                 <input type="hidden" id="slider_range" name="range" class="flat-slider" />
                                                 <button type="submit" class="common_btn">filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree2">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree2" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        size
                                    </button>
                                </h2>
                                <div id="collapseThree2" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree2" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                small
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                medium
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked2">
                                            <label class="form-check-label" for="flexCheckChecked2">
                                                large
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree3">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree3" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        brand
                                    </button>
                                </h2>
                                <div id="collapseThree3" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($brands as $brand)
                                            <li><a href="{{route('frontend.products', ['brand' => $brand->slug])}}">{{$brand->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                          {{--   <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="true"
                                        aria-controls="collapseThree">
                                        color
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefaultc1">
                                            <label class="form-check-label" for="flexCheckDefaultc1">
                                                black
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckCheckedc2">
                                            <label class="form-check-label" for="flexCheckCheckedc2">
                                                white
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckCheckedc3">
                                            <label class="form-check-label" for="flexCheckCheckedc3">
                                                green
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckCheckedc4">
                                            <label class="form-check-label" for="flexCheckCheckedc4">
                                                pink
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckCheckedc5">
                                            <label class="form-check-label" for="flexCheckCheckedc5">
                                                red
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="wsus__product_topbar">
                                <div class="wsus__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button class="list-view nav-link {{session()->has('change_grid_view') && session()->get('change_grid_view') == 'grid' ? 'active' : ''}} {{!session()->has('change_grid_view') ? 'active' : ''}}" data-id="grid" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                        <button class="list-view nav-link {{session()->has('change_grid_view') && session()->get('change_grid_view') == 'list' ? 'active' : ''}}" data-id="list" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>
                                    <div class="wsus__topbar_select">
                                        <select class="select_2" name="state">
                                            <option>default shorting</option>
                                            <option>short by rating</option>
                                            <option>short by latest</option>
                                            <option>low to high </option>
                                            <option>high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="wsus__topbar_select">
                                    <select class="select_2" name="state">
                                        <option>show 12</option>
                                        <option>show 15</option>
                                        <option>show 18</option>
                                        <option>show 21</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            @if (count($products) === 0)
                                <h2 class="text-danger">No Product</h2>
                            @endif
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade {{session()->has('change_grid_view') && session()->get('change_grid_view') == 'grid' ? 'show active' : ''}} {{!session()->has('change_grid_view') ? 'show active' : ''}}" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    @foreach ($products as $key => $product)
                                   <x-product-card :product='$product' :key='$key' />
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade {{session()->has('change_grid_view') && session()->get('change_grid_view') == 'list' ? 'show active' : ''}}" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                    <div class="col-xl-12">
                                        <div class="wsus__product_item wsus__list_view">
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
                                            <div class="wsus__product_details">
                                                <a class="wsus__category" href="#">fashion </a>
                                                <p class="wsus__pro_rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <span>(17 review)</span>
                                                </p>
                                                <a class="wsus__pro_name" href="{{ route('frontend.product-details.index', $product->slug) }}">{{ $product->name }}</a>
                                                @if (checkOffer($product))
                                                <p class="wsus__price">{{ $setting->currency_icon }}{{ $product->offer_price }}
                                                    <del>{{ $setting->currency_icon }}{{ $product->price }}</del>
                                                </p>
                                                @else
                                                    <p class="wsus__price">{{ $setting->currency_icon }}{{ $product->price }}</p>
                                                @endif
                                                <p class="list_description">{!! limitText($product->long_description, 150) !!}</p>
                                                <ul class="wsus__single_pro_icon mt-3">
                                                    <li>
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
                                                    </li>
                                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="far fa-random"></i></a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <section id="pagination">
                            @if ($products->hasPages())
                                {{$products->withQueryString()->links()}}
                            @endif
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PRODUCT PAGE END
    ==============================-->
    @foreach ($products as $product)
<section class="product_popup_modal">
    <div class="modal fade" id="products-{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                    <div class="row">
                        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                            <div class="wsus__quick_view_img">
                                @if ($product->video_link)
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                        href="{{ $product->video_link }}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                @endif
                                <div class="row modal_slider">
                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img class="zoom ing-fluid w-100"
                                                src="{{ asset($product->thumb_image) }}" alt="product">
                                        </div>
                                    </div>
                                    @foreach ($product->productImageGallery as $image)
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img class="zoom ing-fluid w-100" src="{{ asset($image->images) }}"
                                                    alt="product">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="wsus__pro_details_text">
                                <a class="title" href="#">{{ $product->name }}</a>
                                <p class="wsus__stock_area"><span class="in_stock">in stock</span>
                                    ({{ $product->qty }} item)</p>
                                @if (checkOffer($product))
                                    <h4>{{ $setting->currency_icon }}{{ $product->offer_price }}
                                        <del>{{ $setting->currency_icon }}{{ $product->price }}</del>
                                    </h4>
                                @else
                                    <h4>{{ $setting->currency_icon }}{{ $product->price }}</h4>
                                @endif

                                <p class="review">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>20 review</span>
                                </p>
                                <!-- <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia
                                neque
                                sint obcaecati asperiores dolor cumque. ad voluptate dolores reprehenderit hic adipisci
                                Similique eaque illum.</p> -->

                                <div class="wsus_pro_hot_deals">
                                    <h5>offer ending time : </h5>
                                    <div class="simply-countdown simply-countdown-one"></div>
                                </div>
                                <form class="shopping-cart-form">
                                    <div class="wsus__selectbox">
                                        <div class="row">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            @foreach ($product->productVariant as $productVariant)
                                                @if ($productVariant->status != 0)
                                                    <div class="col-md-6">
                                                        <h5 class="mb-2">{{ $productVariant->name }}</h5>
                                                        <select class="select_2" name="variants[]">
                                                            @foreach ($productVariant->productVariantItem as $item)
                                                                @if ($item->status != 0)
                                                                    <option
                                                                        {{ $item->is_default == 1 ? 'selected' : '' }}
                                                                        value="{{ $item->id }}">
                                                                        {{ $item->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="wsus__quentity">
                                        <h5>quentity :</h5>
                                        <div class="select_number">
                                            <input class="number_area" name="qty" type="text" min="1"
                                                max="100" value="1" />
                                        </div>
                                    </div>
                                    <ul class="wsus__button_area">
                                        <li><button class="add_cart" type="submit">add to cart</button></li>
                                        <li><a class="buy_now" href="#">buy now</a></li>
                                        <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                        <li><a href="#"><i class="far fa-random"></i></a></li>
                                    </ul>
                                </form>
                                <p class="brand_model"><span>logo :</span> <img
                                        src="{{ asset($product->brand->logo) }}" alt=""></p>
                                <p class="brand_model"><span>brand :</span> {{ $product->brand->name }}</p>
                                <div class="wsus__pro_det_share">
                                    <h5>share :</h5>
                                    <ul class="d-flex">
                                        <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a>
                                        </li>
                                        <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <a class="wsus__pro_report" href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="fal fa-comment-alt-smile"></i> Report
                                    incorrect
                                    product information.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
          $('.list-view').on('click', function(){
            let style = $(this).data('id');
            $.ajax({
                method:'GET',
                url:'{{route("frontend.products.change-grid-view")}}',
                data:{
                    style:style
                },
                success:function(data){},
                error:function(){}
            })
          })
          @php
              if(request()->has('range') && request()->range != ''){
                $price = explode(';', request()->range);
              }else{
                $price[0] = 0; 
                $price[1] = 50;
              }
          @endphp
          jQuery(function () {
        jQuery("#slider_range").flatslider({
            min: 0,
            max: 50,
            step: 5,
            values: [{{$price[0]}}, {{$price[1]}}],
            range: true,
            einheit: "$",
        });
    });
        })
    </script>
@endpush