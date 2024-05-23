@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Slider</h1>
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
                 <form action="{{route('admin.slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>Image</label>
                    <img src="{{asset($slider->banner)}}" alt="Nai">
                    <input type="file" name="banner" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Type</label>
                    <input type="text" name="type" value="{{$slider->type}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{$slider->title}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" value="{{$slider->price}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Button Link</label>
                    <input type="text" name="button_url" value="{{$slider->button_url}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Serial</label>
                    <input type="number" name="serial" value="{{$slider->serial}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option {{$slider->status == 1 ? 'selected' : ''}} value="1">Active</option>
                      <option {{$slider->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection