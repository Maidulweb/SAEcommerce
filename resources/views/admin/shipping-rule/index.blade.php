@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Show Shipping Rule</h1>
    </div>
   
    <div>
      <a href="{{route('admin.shipping-rule.create')}}">Create</a>
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
    <script>
     $(document).ready(function(){
      $('body').on('click', '.status-active', function(){
        
        let isChecked = $(this).is(':checked');
        let id = $(this).data('id');

        $.ajax({
          method:'PUT',
          url:'{{route('admin.shipping-rule.status')}}',
          data:{
            id:id,
            isChecked:isChecked
          },
          success:function(data){
            toastr.success(data.message)
          },
          error:function(error){
           console.log(error)
          }
        })
      })
     })
    </script>
@endpush

