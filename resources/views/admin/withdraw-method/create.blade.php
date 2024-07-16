@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Vendor Withdraw Requirement</h1>
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
                 <form action="{{route('admin.withdraw.store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Minimum Amount</label>
                    <input type="number" name="minimum_amount" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Maximum Amount</label>
                    <input type="number" name="maximum_amount" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Charge (%)</label>
                    <input type="number" name="charge" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control summernote" id="" cols="30" rows="10"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Withdraw Requierment</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection