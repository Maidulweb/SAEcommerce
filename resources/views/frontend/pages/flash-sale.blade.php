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
                    @php
                        $products = \App\Models\Product::whereIn('id', $flashSaleItems)->get();
                    @endphp
                    @foreach ($products as $key => $product)
                      <x-product-card :product='$product' :key='$key' />
                    @endforeach
                </div>
               {{--  <div class="mt-4">
                    @if ($products->hasPages())
                        {{$products->links()}}
                    @endif
                </div> --}}
            </div>
        </div>
    </section>
    <!--============================
        DAILY DEALS DETAILS END
    ==============================-->
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