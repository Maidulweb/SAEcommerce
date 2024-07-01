@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Social List</h1>
    </div>
    <div class="mt-3 mb-3">
      <a href="{{route('admin.footer-social.create')}}">Create</a>
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
          url:'{{route("admin.footer-social.status")}}',
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

