<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
    <div class="container">
        <div class="row">
            @php
               $singleCategoriesThree = json_decode($singleCategoryThree->value, true);
               $lastkey = [];
            @endphp
           @foreach ($singleCategoriesThree as $items)
           @php
               foreach ($items as $key => $value) {
                    if($value == null){
                    break;
                  }
                  $lastkey = [$key => $value];
                  if (array_keys($lastkey)[0] == 'category') {
                    $category = \App\Models\Category::find($lastkey['category']);
                    $products = \App\Models\Product::with('productReview')->where('category_id', $lastkey['category'])->take(5)->orderBy('id', 'DESC')->get();
                  }elseif(array_keys($lastkey)[0] == 'sub_category'){
                    $category = \App\Models\SubCategory::find($lastkey['sub_category']);
                    $products = \App\Models\Product::with('productReview')->where('sub_category_id', $lastkey['sub_category'])->take(5)->orderBy('id', 'DESC')->get();
                  }else{
                    $category = \App\Models\ChildCategory::find($lastkey['child_category']);
                    $products = \App\Models\Product::with('productReview')->where('child_category_id', $lastkey['child_category'])->take(5)->orderBy('id', 'DESC')->get();
                  }
                 } 
           @endphp
           <div class="col-xl-6 col-sm-6">
            <div class="wsus__section_header">
                <h3>weekly best rated Products</h3>
            </div>
            <div class="row weekly_best2">
                @foreach ($products as $product)
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3  category-{{$key}}">
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
                            <a class="wsus__category" href="#">{{ $product->category->name }} </a>
                            <p class="wsus__pro_rating">
                                @php
                                        $avg = $product->productReview()->avg('rating');
                                        $fullRating = round($avg);
                                    @endphp
                                    @for ($i=1; $i <= 5; $i++)
                                        @if($i <= $fullRating )
                                        <i class="fas fa-star"></i>
                                        @else
                                        <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <span>({{count($product->productReview)}} review)</span>
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
        </div>
        @endforeach
        </div>
    </div>
</section>