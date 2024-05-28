@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Update Brand</h1>
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
                 <form action="{{route('admin.brand.update', $brand->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>Logo</label>
                    <img src="{{asset($brand->logo)}}" alt="Nai">
                    <input type="file" name="logo" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$brand->name}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Is Featured</label>
                    <select name="is_featured" class="form-control">
                      <option  value="1">Yes</option>
                      <option  value="0">No</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option {{$brand->status == 1 ? 'selected' : ''}} value="1">Active</option>
                      <option {{$brand->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection