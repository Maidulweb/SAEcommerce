@foreach ($flashSaleItems as $flashSaleItem)
    @php
        $product = \App\Models\Product::find($flashSaleItem->product_id);
    @endphp
    <section class="product_popup_modal">
        <div class="modal fade" id="exampleModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
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
