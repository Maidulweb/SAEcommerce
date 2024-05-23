@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Edit Category</h1>
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
                 <form action="{{route('admin.category.update', $category->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>Icon</label>
                    <input type="file" name="icon" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" value="{{$category->name}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Category Slug</label>
                    <input type="text" name="slig" value="{{$category->slig}}" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Category Update</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection