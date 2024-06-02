@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Show Pending Product</h1>
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
        $('body').on('change', '.approved', function(){
          let pending = $(this).val();
          let id = $(this).data('id');
          $.ajax({
            method:'PUT',
            url:"{{route('admin.pending-product-approved.update')}}",
            data:{
              id:id,
              pending:pending
            },
            success:function(data){
              
                toastr.success(data.message)
                window.location.reload();
            },
            error:function(xhr,status,error){
                console.log(error)
            }
          })
        })

       
      })
    </script>
@endpush

