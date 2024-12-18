@extends('frontend.layouts.master')
@section('title')
{{$setting->site_name}} - Home
@endsection
@section('content')
<!--============================
        BANNER PART 2 START
    ==============================-->
  @include('frontend.home.sections.banner')
    <!--============================
        BANNER PART 2 END
    ==============================-->


    <!--============================
        FLASH SELL START
    ==============================-->
   @include('frontend.home.sections.flash-sell')
    <!--============================
        FLASH SELL END
    ==============================-->


    <!--============================
       MONTHLY TOP PRODUCT START
    ==============================-->
  @include('frontend.home.sections.popular-product')
    <!--============================
       MONTHLY TOP PRODUCT END
    ==============================-->


    <!--============================
        BRAND SLIDER START
    ==============================-->
    @include('frontend.home.sections.brand') 
    <!--============================
        BRAND SLIDER END
    ==============================-->



    <!--============================
        HOT DEALS START
    ==============================-->
   @include('frontend.home.sections.hot-deal') 
    <!--============================
        HOT DEALS END  
    ==============================-->


    <!--============================
        ELECTRONIC PART START  
    ==============================-->
   @include('frontend.home.sections.single-category')
    <!--============================
        ELECTRONIC PART END  
    ==============================-->

    <!--============================
        ELECTRONIC PART START  
    ==============================-->
    @include('frontend.home.sections.single-category-two') 
    <!--============================
        ELECTRONIC PART END  
    ==============================-->



    <!--============================
        WEEKLY BEST ITEM START  
    ==============================-->
  @include('frontend.home.sections.weekly-best-item') 
    <!--============================
        WEEKLY BEST ITEM END 
    ==============================-->


    <!--============================
        HOME BLOGS START
    ==============================-->
 @include('frontend.home.sections.blog') 
    <!--============================
        HOME BLOGS END
    ==============================-->
@endsection

@push('scripts')
    <script>
       /*  toastr.warning(message) */
    </script>
@endpush