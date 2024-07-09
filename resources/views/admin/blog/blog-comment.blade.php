@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Blog Comment List</h1>
    </div>
    <div>
    <a href="{{route('admin.blog.create')}}">Create</a>
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

