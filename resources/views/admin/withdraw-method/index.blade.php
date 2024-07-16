@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Withdraw Method</h1>
    </div>
   <div>
    <a class="btn btn-primary" href="{{route('admin.withdraw.create')}}">Create</a>
   </div>
    <div class="section-body mb-0">
          <div class="card">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
          </div>
    </div>
  </section>
  
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

