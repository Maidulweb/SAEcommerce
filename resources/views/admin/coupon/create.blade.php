@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Coupon</h1>
    </div>

    <div class="section-body mb-0">
          <div class="card">
            <div class="card-body">
                <div>
                    <a href="{{route('admin.coupon.index')}}">Back</a>
                  </div> 
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
                 <form action="{{route('admin.coupon.store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Code</label>
                    <input type="text" name="code" value="{{old('code')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Max Use Per Person</label>
                    <input type="text" name="max_use_person" value="{{old('max_use_person')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" name="start_date" value="{{old('start_date')}}" class="form-control datepicker">
                  </div>
                  <div class="form-group">
                    <label>End Date</label>
                    <input type="text" name="end_date" value="{{old('end_date')}}" class="form-control datepicker">
                  </div>
                  
                  <div class="form-group">
                    <label>Discount Type</label>
                    <select name="discount_type" class="form-control">
                        <option value="percentage">Percentage (%)</option>
                        <option value="amount">Amount ({{$setting->currency_icon}})</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Discount Amount</label>
                    <input type="text" name="discount" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Coupon</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection