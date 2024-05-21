@extends('vendor.dashboard.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
      <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="far fa-user"></i> profile</h3>
        <div class="wsus__dashboard_profile">
          <div class="wsus__dash_pro_area">
            <h4>basic information</h4>
     
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
                <form action="{{route('vendor.profile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-xl-9">
                        <div class="row">
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-user-tie"></i>
                              <input type="text" name="name" value="{{Auth::user()->name}}" placeholder="Name">
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-user-tie"></i>
                              <input type="text" name="username" value="{{Auth::user()->username}}" placeholder="Username">
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="far fa-phone-alt"></i>
                              <input type="text" name="phone" value="{{Auth::user()->phone}}" placeholder="Phone">
                            </div>
                          </div>
                          <div class="col-xl-6 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="fal fa-envelope-open"></i>
                              <input type="email" name="email" value="{{Auth::user()->email}}" placeholder="Email">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 col-md-6">
                        <div class="wsus__dash_pro_img">
                          <img src="{{Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/images/ts-2.jpg')}}" alt="img" class="img-fluid w-100">
                          <input name="image" type="file">
                        </div>
                      </div>
                      <div class="col-xl-12">
                        <button class="common_btn mb-4 mt-2" type="submit">Update</button>
                      </div>
                </form>
                <div class="wsus__dash_pass_change mt-2">
                  <div class="row">
                    <form action="{{route('vendor.password.update')}}" method="POST">
                        @csrf
                    <div class="col-xl-4 col-md-6">
                      <div class="wsus__dash_pro_single">
                        <i class="fas fa-unlock-alt"></i>
                        <input type="password" name="current_password" placeholder="Current Password">
                      </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                      <div class="wsus__dash_pro_single">
                        <i class="fas fa-lock-alt"></i>
                        <input type="password" name="password" placeholder="New Password">
                      </div>
                    </div>
                    <div class="col-xl-4">
                      <div class="wsus__dash_pro_single">
                        <i class="fas fa-lock-alt"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password">
                      </div>
                    </div>
                    <div class="col-xl-12">
                      <button class="common_btn" type="submit">Upadated Password</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection