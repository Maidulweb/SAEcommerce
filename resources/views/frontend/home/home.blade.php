@extends('frontend.layouts.master')
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
   @include('frontend.home.sections.monthly-top-product')
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
        SINGLE BANNER START
    ==============================-->
  @include('frontend.home.sections.single-banner')
    <!--============================
        SINGLE BANNER END  
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
   @include('frontend.home.sections.electronic')
    <!--============================
        ELECTRONIC PART END  
    ==============================-->


    <!--============================
        LARGE BANNER  START  
    ==============================-->
  @include('frontend.home.sections.large-banner')
    <!--============================
        LARGE BANNER  END  
    ==============================-->


    <!--============================
        WEEKLY BEST ITEM START  
    ==============================-->
  @include('frontend.home.sections.weekly-best-item')
    <!--============================
        WEEKLY BEST ITEM END 
    ==============================-->


    <!--============================
      HOME SERVICES START
    ==============================-->
@include('frontend.home.sections.home-services')
    <!--============================
        HOME SERVICES END
    ==============================-->


    <!--============================
        HOME BLOGS START
    ==============================-->
  @include('frontend.home.sections.blog')
    <!--============================
        HOME BLOGS END
    ==============================-->
@endsection