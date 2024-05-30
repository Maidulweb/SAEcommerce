@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Update -- {{$variant->name}} -- Variant</h1>
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
                 <form action="{{route('admin.product-variant.update', $variant->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>Variant Name</label>
                    <input type="text" name="name" class="form-control" value="{{$variant->name}}">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option {{$variant->status==1 ? 'selected' : ''}} value="1">Active</option>
                      <option {{$variant->status==0 ? 'selected' : ''}} value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Product Variant</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection