@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Vendor</h1>
    </div>

    <div class="section-body mb-0">
          <div class="card">
            <div class="card-body">
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
                 <form action="{{route('admin.vendor-profile.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label>Shop Name</label>
                    <input type="text" name="shop_name" value="{{$profile->shop_name}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Banner</label>
                     <img src="{{asset($profile->banner)}}" alt="Nai">
                    <input type="file" name="banner" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{$profile->phone}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="{{$profile->address}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{$profile->email}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control summernote" name="description">{{$profile->description}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Facebook</label>
                    <input type="text" name="fb_link" value="{{$profile->fb_link}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Twitter</label>
                    <input type="text" name="tw_link" value="{{$profile->tw_link}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Instagram</label>
                    <input type="text" name="insta_link" value="{{$profile->insta_link}}" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Create</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection