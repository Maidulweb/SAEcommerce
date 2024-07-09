@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Blog</h1>
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
                 <form action="{{route('admin.blog.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label>Category Name</label>
                    <select name="category_id" id="" class="form-control">
                      <option value="">Select</option>
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                   <input type="file" class="form-control" name="image">
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                   <input type="text" class="form-control" name="title">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea rows="1" cols="1" class="form-control summernote" name="description"></textarea>
                  </div>
                  <div class="form-group">
                    <label>SEO Title</label>
                    <input type="text" class="form-control" name="seo_title">
                  </div>
                  <div class="form-group">
                    <label>SEO Description</label>
                    <textarea rows="1" cols="1" class="form-control summernote" name="seo_description"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Blog</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection