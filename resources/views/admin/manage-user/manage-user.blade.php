@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Manage User</h1>
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
                 <form action="{{route('admin.manage-user.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                      <option value="admin">Admin</option>
                      <option value="vendor">Vendor</option>
                      <option value="user">User</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Create User</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection