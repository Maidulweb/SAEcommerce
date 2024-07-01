@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Edit Footer Grid Three</h1>
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
                 <form action="{{route('admin.footer-grid-three.update', $footer_grid_three->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$footer_grid_three->name}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="url" value="{{$footer_grid_three->url}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option {{$footer_grid_three->status == 1 ? 'selected' : ''}} value="1">Active</option>
                      <option {{$footer_grid_three->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Grid Three</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection