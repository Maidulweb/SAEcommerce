@extends('vendor.layouts.master')
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
                 <div class="text-right">
                  <a href="{{route('vendor.product.create')}}">Create Variant</a>
                 </div>
                <div class="wsus__dash_pass_change mt-2 shop-profile">
                  <form action="{{route('vendor.product-variant.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Variant Name</label>
                      <input type="text" name="name" class="form-control">
                    </div>
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Product Variant</button>
                   </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection