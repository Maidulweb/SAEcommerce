@extends('frontend.dashboard.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
      <div class="dashboard_content">
        <div class="wsus__dashboard">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush