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
                    <a href="{{route('admin.shipping-rule.index')}}">Back</a>
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
              <form action="{{route('admin.shipping-rule.update', $shippingRule->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" value="{{$shippingRule->name}}" class="form-control">
                </div>
                
                <div class="form-group">
                  <label>Type</label>
                  <select name="type" class="form-control flat-min-amount">
                      <option {{$shippingRule->type == 'flat_cost' ? 'selected' : ''}} value="flat_cost">Flat Cost</option>
                      <option {{$shippingRule->type == 'min_order_amount' ? 'selected' : ''}}  value="min_order_amount">Minimum Order Amount</option>
                  </select>
                </div>
                <div class="form-group min-cost {{$shippingRule->type == 'flat_cost' ? 'd-none' : ''}}">
                  <label>Min Cost</label>
                  <input type="text" name="min_cost" value="{{$shippingRule->type == 'flat_cost' ? 0 : $shippingRule->min_cost}}" class="form-control">
                </div>
                <div class="form-group">
                  <label>Cost</label>
                  <input type="text" name="cost" value="{{$shippingRule->cost}}" class="form-control">
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                      <option {{$shippingRule->status == 1 ? 'selected' : ''}} value="1">Active</option>
                      <option {{$shippingRule->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Create Shipping Rule</button>
               </form>
            </div>
          </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){
      $('body').on('change', '.flat-min-amount', function(){
        let value = $(this).val();
        if(value == 'flat_cost'){
          $('.min-cost').addClass('d-none');
        }else{
          $('.min-cost').removeClass('d-none');
          
        }
      })
    })
  </script>
@endpush