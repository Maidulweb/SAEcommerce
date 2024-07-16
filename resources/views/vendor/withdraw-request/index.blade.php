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
                 <div class="text-right">
                  <a class="btn btn-primary" href="{{route('vendor.withdraw.create')}}">Create Withdraw Request</a>
                 </div>
                <div class="wsus__dash_pass_change mt-2 shop-profile">
                  {{ $dataTable->table() }}
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush