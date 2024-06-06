@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Update Coupon</h1>
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
                 <form action="{{route('admin.coupon.update', $coupon->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$coupon->name}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Code</label>
                    <input type="text" name="code" value="{{$coupon->code}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" value="{{$coupon->quantity}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Max Use Per Person</label>
                    <input type="text" name="max_use_person" value="{{$coupon->max_use_person}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" name="start_date" value="{{$coupon->start_date}}" class="form-control datepicker">
                  </div>
                  <div class="form-group">
                    <label>End Date</label>
                    <input type="text" name="end_date" value="{{$coupon->end_date}}" class="form-control datepicker">
                  </div>
                  
                  <div class="form-group">
                    <label>Discount Type</label>
                    <select name="discount_type" class="form-control">
                        <option {{$coupon->discount_type == 'percentage' ? 'selected' : ''}} value="percentage">Percentage (%)</option>
                        <option {{$coupon->discount_type == 'amount' ? 'selected' : ''}} value="amount">Amount ({{$setting->currency_icon}})</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Discount Amount</label>
                    <input type="text" name="discount" value="{{$coupon->discount}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option {{$coupon->status == 1 ? 'selected' : ''}} value="1">Active</option>
                        <option {{$coupon->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Coupon</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection