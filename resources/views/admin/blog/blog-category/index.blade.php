@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Blog Category List</h1>
    </div>
    <div>
    <a href="{{route('admin.blog-category.create')}}">Create</a>
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
          url:'{{route("admin.blog-category.status")}}',
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
