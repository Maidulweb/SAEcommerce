@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Category</h1>
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
                 <form action="{{route('admin.footer-info.update', 1)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <img src="{{asset($footer_info->logo)}}" alt="">
                  <div class="form-group">
                    <label>Logo</label>
                    <input type="file" name="logo" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{$footer_info->phone}}">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{$footer_info->email}}">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{$footer_info->address}}">
                  </div>
                  <button type="submit" class="btn btn-primary">Update Footer Info</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection