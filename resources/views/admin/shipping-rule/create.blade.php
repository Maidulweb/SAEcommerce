@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Shipping Rule</h1>
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
                 <form action="{{route('admin.shipping-rule.store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                  </div>
                  
                  <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-control flat-min-amount">
                        <option value="flat_cost">Flat Cost</option>
                        <option value="min_order_amount">Minimum Order Amount</option>
                    </select>
                  </div>
                  <div class="form-group d-none min-cost">
                    <label>Min Cost</label>
                    <input type="text" name="min_cost" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Cost</label>
                    <input type="text" name="cost" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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