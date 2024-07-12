@extends('vendor.layouts.master')
@section('content')
<div class="row">
  <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
    <div class="dashboard_content">
      <div class="wsus__dashboard">
        <div class="row">
          <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item red" href="dsahboard_order.html">
              <i class="far fa-address-book"></i>
              <p>Pending Order</p>
              <p>{{$pending_order}}</p>
            </a>
          </div>
          <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item red" href="dsahboard_order.html">
              <i class="far fa-address-book"></i>
              <p>Delivered Order</p>
              <p>{{$delivered_order}}</p>
            </a>
          </div>
          <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item red" href="dsahboard_order.html">
              <i class="far fa-address-book"></i>
              <p>Today Earning</p>
              <p>{{$today_earning}}</p>
            </a>
          </div>
          <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item red" href="dsahboard_order.html">
              <i class="far fa-address-book"></i>
              <p>Monthly Earning</p>
              <p>{{$monthly_earning}}</p>
            </a>
          </div>
          <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item red" href="dsahboard_order.html">
              <i class="far fa-address-book"></i>
              <p>Year Earning</p>
              <p>{{$year_earning}}</p>
            </a>
          </div>
          <div class="col-xl-2 col-6 col-md-4">
            <a class="wsus__dashboard_item red" href="dsahboard_order.html">
              <i class="far fa-address-book"></i>
              <p>Total Earning</p>
              <p>{{$total_earning}}</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection