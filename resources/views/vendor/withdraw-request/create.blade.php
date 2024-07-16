@extends('vendor.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
      <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="far fa-user"></i> Withdraw Request</h3>
        <div class="wsus__dashboard_profile">
          <div class="wsus__dash_pro_area">
            <h4>Withdraw Request</h4>
     
              <div class="row">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            
                <div class="wsus__dash_pass_change mt-2 shop-profile">
                  <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('vendor.withdraw.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label>Name</label>
                              <select name="method" id="method" class="form-control">
                                <option value="">Select</option>
                                  @foreach ($methods as $method)
                                  <option value="{{$method->id}}">{{$method->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Withdraw Amount</label>
                              <input type="number" name="amount" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Account Info</label>
                                <textarea name="account_info" class="form-control" id="" cols="30" rows="10"></textarea>
                              </div>
                            <button type="submit" class="btn btn-primary">Create Product</button>
                           </form>
                    </div>
                    <div class="col-md-6">
                        <h6>Account Details</h6>
                        <hr>
                        <div id="account_info">
                           
                        </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script>
     $(document).ready(function(){
        $('body').on('change', '#method', function(){
          let id = $(this).val();
          console.log('check')
          $.ajax({
            method:'GET',
            url:"{{route('vendor.withdraw.show', ':id')}}".replace(':id', id),
            success:function(data){
                $('#account_info').html(
                    `
                    <h6>Method: ${data.name}</h6>
                    <p>Payment Range: ${data.minimum_amount} - ${data.maximum_amount}</p>
                    <p>Withdraw Charge: ${data.charge}</p>
                    <p>Description: ${data.description}</p>
                    `
                );
            },
            error:function(xhr,status,error){
                console.log(error)
            }
          })
        })       
      })
</script>
@endpush