@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Profile</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Hi, {{Auth::user()->name}}</h2>
     

      <div class="row mt-sm-4">
      
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">
            <form method="post" class="needs-validation" novalidate="" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
              @csrf
              <div class="card-header">
                <h4>Update Profile</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Image</label>
                      <img src="{{Auth::user()->image}}" alt="image">
                      <input type="file" class="form-control" name="image">
                    </div>                               
                    <div class="form-group col-md-6 col-12">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
                    </div>
                  </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Update Profile</button>
              </div>
            </form>
          </div>
          <div class="card">
            <form method="post" class="needs-validation" novalidate="" action="{{route('admin.password.update')}}">
              @csrf
              <div class="card-header">
                <h4>Update Profile</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Current Password</label>
                      <input type="password" class="form-control" name="current_password">
                      @if($errors->has('current_password'))
                      <code>{{$errors->first('current_password')}}</code>
                      @endif
                    </div>                               
                    <div class="form-group col-12">
                      <label>New Password</label>
                      <input type="password" class="form-control" name="password">
                      @if($errors->has('password'))
                      <code>{{$errors->first('password')}}</code>
                      @endif
                    </div>
                    <div class="form-group col-12">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control" name="password_confirmation">
                      @if($errors->has('password_confirmation'))
                      <code>{{$errors->first('password_confirmation')}}</code>
                      @endif
                    </div>
                  </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Update Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection