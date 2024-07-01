@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Social Link</h1>
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
                 <form action="{{route('admin.footer-social.store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <button name="icon" class="btn btn-primary" role="iconpicker">Icon</button>
                  </div>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="url" value="{{old('url')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Social Link</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection