@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Category</h1>
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
                 <form action="{{route('admin.category.store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label>Icon</label>
                    <input type="file" name="icon" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Category Slug</label>
                    <input type="text" name="slug" value="{{old('slug')}}" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Create Category</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection