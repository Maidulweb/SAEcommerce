@extends('frontend.dashboard.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
      <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="far fa-user"></i> Vendor Request</h3>
          <div class="wsus__dash_pro_area">
          @php
            $content = \App\Models\VendorCondition::first();
          @endphp
          <p>{!!$content->content!!}</p>
        </div>
        <div class="wsus__dashboard_profile">
          <div class="wsus__dash_pro_area">
            
              <div class="row">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('vendor.request-page.create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xl-9">
                        <div class="row">
                          
                          <div class="col-xl-12 col-md-12">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-user-tie"></i>
                              <input type="file" name="banner">
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="far fa-phone-alt"></i>
                              <input type="text" name="shop_name" placeholder="Shop name">
                            </div>
                      </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-user-tie"></i>
                              <input type="text" name="phone" placeholder="Phone">
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="far fa-phone-alt"></i>
                              <input type="text" name="address" placeholder="Address">
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="fal fa-envelope-open"></i>
                              <input type="email" name="email" placeholder="Email">
                            </div>
                          </div>
                          <div class="col-xl-12 col-md-12">
                            <div class="wsus__dash_pro_single">
                              <i class="fal fa-envelope-open"></i>
                              <textarea name="description" id="" >Description</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-12">
                        <button class="common_btn mb-4 mt-2" type="submit">Request</button>
                      </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection