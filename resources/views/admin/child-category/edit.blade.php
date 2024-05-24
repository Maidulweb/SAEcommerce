@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Update Child Category</h1>
    </div>

    <div class="section-body mb-0">
          <div class="card">
            <div class="card-body">
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
                 <form action="{{route('admin.child-category.update', $childcategory->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>Category Name</label>
                    <select name="category_id" class="form-control main-category">
                      @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sub Category Name</label>
                    <select name="sub_category_id" class="form-control sub-category">
                      @foreach ($subcategories as $subcategory)
                      <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Child Category Name</label>
                    <input type="text" name="name" value="{{$childcategory->name}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Category</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
  $(document).ready(function(){
    $('body').on('change', '.main-category', function(){
      let id = $(this).val();
      $.ajax({
        method:'GET',
        url:'{{route('admin.childcategory.sub-category')}}',
        data:{
          id:id
        },
        success:function(data){
         $('.sub-category').html('<option value="">Select</option>')
         $.each(data,function(i,item){
          $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
         })
        },
        error:function(error){

        }
      })
    })
  })
</script>
@endpush