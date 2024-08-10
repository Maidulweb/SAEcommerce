<section id="wsus__hot_deals" class="wsus__hot_deals_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>hot deals of the day</h3>
                </div>
            </div>
        </div>
        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header justify-content-start">
                        <div class="monthly_top_filter2 mb-1">
                            <button class="auto-click active" data-filter=".top_product">Top Product</button>
                            <button data-filter=".new_product">New Product</button>
                            <button data-filter=".featured_product">Featured Product</button>
                            <button data-filter=".best_product">Best Product</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grid2">
                    @foreach ($getTypeProducts as $key => $products)
                        @foreach ($products as $product)
                        <x-product-card :product='$product' :key='$key' />
                        @endforeach
                    @endforeach
            </div>
        </div>

        <section id="wsus__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    @php
                        $banner = \App\Models\Advertisement::where('key', 'advertisement_banner_three')->first();
                        $banner = json_decode($banner->value);
                    @endphp
                    <div class="col-xl-6 col-lg-6">
                        @if ($banner->banner_one->status == 1)
                        <a href="{{$banner->banner_one->url}}">
                            <div class="wsus__single_banner_content banner_1">
                                <div class="wsus__single_banner_img">
                                    <img src="{{asset($banner->banner_one->banner)}}" alt="banner" class="img-fluid w-100">
                                </div>
                            </div>
                        </a> 
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                @if ($banner->banner_two->status == 1)
                                <a href="{{$banner->banner_two->url}}">
                                    <div class="wsus__single_banner_content single_banner_2">
                                        <div class="wsus__single_banner_img">
                                            <img src="{{asset($banner->banner_two->banner)}}" alt="banner" class="img-fluid w-100">
                                        </div>
                                    </div>
                                </a>
                                @endif
                            </div>
                            <div class="col-12 mt-lg-4">
                                @if ($banner->banner_three->status == 1)
                                <a href="{{$banner->banner_three->url}}">
                                    <div class="wsus__single_banner_content">
                                        <div class="wsus__single_banner_img">
                                            <img src="{{asset($banner->banner_three->banner)}}" alt="banner" class="img-fluid w-100">
                                        </div>
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
