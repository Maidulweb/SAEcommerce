@php
    $popularCategories = json_decode($popularCategoryAll->value, true);
@endphp
<section id="wsus__monthly_top" class="wsus__monthly_top_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                @php
                    $banner_popular = \App\Models\Advertisement::where('key', 'advertisement_banner_one')->first();
                    $banner_popular = json_decode($banner_popular->value);
                @endphp
                @if ($banner_popular->banner_one->status == 1)
                        <a href="{{$banner_popular->banner_one->url}}">
                            <div class="wsus__monthly_top_banner">
                                <div class="wsus__monthly_top_banner_img">
                                    <img src="{{asset($banner_popular->banner_one->banner)}}" alt="img" class="img-fluid w-100">
                                    <span></span>
                                </div>
                            </div>
                        </a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header for_md">
                    <h3>Popular Product</h3>
                    <div class="monthly_top_filter">
                        
                        @php
                            $products = [];
                        @endphp
                        @foreach ($popularCategories as $popularCategory)
                         @php
                             $lastkey = [];
                             foreach ($popularCategory as $key => $item){
                                if ($item == null) {
                                   break;
                                }
                              $lastkey = [$key => $item];
                             }
                             
                            if(array_keys($lastkey)[0] == 'category'){
                                $finalItem = \App\Models\Category::find($lastkey['category']);
                                $products[] = \App\Models\Product::with('productReview')->where('category_id', $finalItem->id)->take(12)->get();     
                            }elseif(array_keys($lastkey)[0] == 'sub_category'){
                                $finalItem = \App\Models\SubCategory::find($lastkey['sub_category']);
                                $products[] = \App\Models\Product::with('productReview')->where('sub_category_id', $finalItem->id)->take(12)->get();    
                            }else{
                                $finalItem = \App\Models\ChildCategory::find($lastkey['child_category']); 
                                $products[] = \App\Models\Product::with('productReview')->where('child_category_id', $finalItem->id)->take(12)->get();   
                            }
                         @endphp
                        <button class="{{$loop->index === 0 ? 'active auto-click' : ''}}" data-filter=".category-{{$loop->index}}">{{$finalItem->name}}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">
                    @foreach ($products as $key => $items)
                     @foreach ($items as $product)
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
                    @endforeach
                   
                </div>
            </div>
        </div>
    </div>
</section>