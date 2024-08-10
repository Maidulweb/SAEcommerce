<section id="wsus__flash_sell" class="wsus__flash_sell_2">
        <div class=" container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="offer_time" style="background: url({{ asset('frontend/images/flash_sell_bg.jpg') }})">
                        <div class="wsus__flash_coundown">
                            <span class=" end_text">flash sell</span>
                            <div class="simply-countdown simply-countdown-one"></div>
                            <a class="common_btn" href="{{ route('pages.flash-sale.index') }}">see more <i
                                    class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flash_sell_slider">
               
                    @php
                        $products = \App\Models\Product::withAvg('productReview', 'rating')->withCount('productReview')
                        ->with(['productImagegallery','category','productVariant'])->whereIn('id', $flashSaleItems)->get();
                    @endphp
                 @foreach ($products as $product)
                    <x-product-card :product='$product'/>
                @endforeach
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $(document).ready(function() {
                simplyCountdown('.simply-countdown-one', {
                    year: {{ date('Y', strtotime($flashSaleDate->flash_sale_end_date)) }},
                    month: {{ date('m', strtotime($flashSaleDate->flash_sale_end_date)) }},
                    day: {{ date('d', strtotime($flashSaleDate->flash_sale_end_date)) }},
                });
            })
        </script>
    @endpush
