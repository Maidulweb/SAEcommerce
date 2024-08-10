@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Vendor Withdraw Request</h1>
    </div>
    <div class="section-body mb-0">
          <div class="card">
            <div class="card-body">
                <p>Method: {{$method->method == 1 ? 'Bank' : 'Paypal'}}</p>
                <p>Total Amount: {{$method->total_amount}}</p>
                <p>Charge: {{$method->charge}}</p>
                <p>Withdraw Amount: {{$method->withdraw_amount}}</p>
                <p>Account Info: {{$method->account_info}}</p>
                <p>Status: {{$method->status}}</p:>
            </div>
          </div>
    </div>

    <div class="section-body mb-0">
        <div class="card">
          <div class="card-body">
             <form action="{{route('admin.vendor-withdraw-request.update',$method->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <select name="status" id="" class="form-control">
                        <option @selected($method->status == 'pending') value="pending">pending</option>
                        <option @selected($method->status == 'paid') value="paid">paid</option>
                        <option @selected($method->status == 'decline') value="decline">decline</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
             </form>
          </div>
        </div>
  </div>
  </section>
  
@endsection





