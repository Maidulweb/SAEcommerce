@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Category List</h1>
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

