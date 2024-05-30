@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Show {{$product->name}} Image Gallery</h1>
    </div>

    <div class="section-body mb-0">
      <div class="card">
        <div class="card-body">
          <div><h2><a href="{{route('admin.product.index')}}">Back</a></h2></div>
          <h2>{{$product->name}} -- Multi Images</h2>
          
            <form action="{{route('admin.product-image-gallery.store')}}" enctype="multipart/form-data" method="POST">
              @csrf
              <div class="form-group">
                <label>Thumb Image</label>
                <input multiple type="file" name="images[]" class="form-control">
              </div>
              <input type="hidden" name='product_id' value="{{$product->id}}">
              <button class="btn btn-primary" type="submit">Create Image Gallery</button>
            </form>
        </div>
      </div>
    </div>

    <div class="section-body mb-0">
          <div class="card">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
          </div>
    </div>
  </section>
  
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

