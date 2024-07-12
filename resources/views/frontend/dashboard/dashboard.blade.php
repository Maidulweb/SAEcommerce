@extends('frontend.dashboard.layouts.master')
@section('content')
<div class="row">
  <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
    <div class="dashboard_content">
      <div class="wsus__dashboard">
        <div class="row">
          <div class="col-xl-3 col-6 col-md-4">
            <a class="wsus__dashboard_item red" href="dsahboard_order.html">
              <i class="far fa-address-book"></i>
              <p>total order</p>
              <p><strong>{{$total_order}}</strong></p>
            </a>
          </div>
          <div class="col-xl-3 col-6 col-md-4">
            <a class="wsus__dashboard_item red" href="dsahboard_order.html">
              <i class="far fa-address-book"></i>
              <p>pending order</p>
              <p><strong>{{$pending_order}}</strong></p>
            </a>
          </div>
          <div class="col-xl-3 col-6 col-md-4">
            <a class="wsus__dashboard_item green" href="dsahboard_download.html">
              <i class="fal fa-cloud-download"></i>
              <p>complete order</p>
              <p><strong>{{$delivered_order}}</strong></p>
            </a>
          </div>
          <div class="col-xl-3 col-6 col-md-4">
            <a class="wsus__dashboard_item sky" href="dsahboard_review.html">
              <i class="fas fa-star"></i>
              <p>review</p>
              <p><strong>{{$reviews}}</strong></p>
            </a>
          </div>
          <div class="col-xl-3 col-6 col-md-4">
            <a class="wsus__dashboard_item blue" href="{{route('user.wishlist.index')}}">
              <i class="far fa-heart"></i>
              <p>wishlist</p>
              <p><strong>{{$wishlists}}</strong></p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection