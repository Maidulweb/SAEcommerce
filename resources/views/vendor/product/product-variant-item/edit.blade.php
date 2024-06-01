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
            
                <div class="wsus__dash_pass_change mt-2 shop-profile">
                  <form action="{{route('vendor.product-variant-item.update', $variant->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <h4>Variant Name : <span class="text-success">{{$variant->productVariant->name}}</span></h4>
                    </div>
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" value="{{$variant->name}}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Price</label>
                      <input type="number" name="price" value="{{$variant->price}}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Is Default</label>
                      <select name="is_default" class="form-control">
                        <option value="">Select</option>
                        <option {{$variant->is_default == 1 ? 'selected' : ''}} value="1">Yes</option>
                        <option {{$variant->is_default == 0 ? 'selected' : ''}} value="0">No</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-control">
                        <option value="">Select</option>
                        <option {{$variant->status == 1 ? 'selected' : ''}} value="1">Active</option>
                        <option {{$variant->status == 1 ? 'selected' : ''}} value="0">Inactive</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Variant Item</button>
                   </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection