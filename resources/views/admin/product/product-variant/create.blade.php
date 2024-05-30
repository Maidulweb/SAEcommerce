@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create -- {{$product->name}} -- Variant</h1>
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
              <div><a href="{{route('admin.product-variant.index')}}">Back</a></div>
                 <form action="{{route('admin.product-variant.store')}}" method="POST">
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
  </section>
@endsection