@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Product Variant Item</h1>
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
                 <form action="{{route('admin.product-variant-item.update', $variant->id)}}" method="POST">
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
  </section>
@endsection
