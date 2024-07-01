@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Edit Footer Grid Two</h1>
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
                 <form action="{{route('admin.footer-grid-two.update', $footer_grid_two->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$footer_grid_two->name}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="url" value="{{$footer_grid_two->url}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option {{$footer_grid_two->status == 1 ? 'selected' : ''}} value="1">Active</option>
                      <option {{$footer_grid_two->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Grid Two</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection