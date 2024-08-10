<div class="col-xl-3 col-sm-6 col-lg-4 {{$key}}">
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
            <li><a class="modal-data show_product_modal" href="#" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-id="{{$product->id}}"><i
                        class="far fa-eye"></i></a></li>
            <li><a href="" class="add_to_wishlist" data-id="{{$product->id}}"><i class="far fa-heart wishlist-heart"></i></a></li>
            <li><a href="#"><i class="far fa-random"></i></a>
        </ul>
        <div class="wsus__product_details">
            <a class="wsus__category" href="#">{{ $product->category->name }} </a>
            <p class="wsus__pro_rating">    
               
                @for ($i=1; $i <= 5; $i++)
                    @if($i <= $product->productReview_avg_rating )
                    <i class="fas fa-star"></i>
                    @else
                    <i class="far fa-star"></i>
                    @endif
                @endfor
                <span>({{$product->productReview_count}} review)</span>
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