@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Footer Grid Three List</h1>
    </div>
     <div class="mt-3 mb-3">
      <form action="{{route('admin.footer-grid-three.title')}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="footer_grid_three_title" value="{{old('name')}}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create Title</button>
       </form>
    </div>
    <div class="mt-3 mb-3">
      <a href="{{route('admin.footer-grid-three.create')}}">Create</a>
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
          url:'{{route("admin.footer-grid-three.status")}}',
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

