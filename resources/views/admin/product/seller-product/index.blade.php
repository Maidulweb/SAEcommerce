@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Show Seller Product</h1>
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
        $('body').on('click', '.product-active', function(){
          let is_checked = $(this).is(':checked');
          let id = $(this).data('id');
          $.ajax({
            method:'POST',
            url:"{{route('admin.product.status')}}",
            data:{
              id:id,
              is_checked:is_checked
            },
            success:function(data){
                toastr.success(data.message)
            },
            error:function(xhr,status,error){
                console.log(error)
            }
          })
        })

       
      })
    </script>
@endpush

