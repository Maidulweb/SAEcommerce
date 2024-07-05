@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Product Review</h1>
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
      $('body').on('click', '.change-status', function(){
        let isChecked = $(this).is(':checked')
        let id = $(this).data('id');
        $.ajax({
          method:'PUT',
          url:'{{route("admin.product-review.status")}}',
          data:{
            isChecked:isChecked,
            id:id,
          },
          success:function(data){
            toastr.success(data.message);
        
          },
          error:function(status,error){
            console.log(status);
            console.log(error);
          }
        })
      })
    });
    </script>
@endpush

