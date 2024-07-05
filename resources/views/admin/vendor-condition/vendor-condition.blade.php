@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Vendor Condition</h1>
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
                 <form action="{{route('admin.vendor-condition.update')}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>Content</label>
                    <textarea rows="1" cols="1" class="form-control summernote" name="content">{{$content->content}}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Vendor Condition</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection
