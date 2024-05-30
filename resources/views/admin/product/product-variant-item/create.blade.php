@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Product Variant Item</h1>
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
                 <form action="{{route('admin.product-variant-item.store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <h4>Variant Name : <span class="text-success">{{$variant->name}}</span></h4>
                  </div>
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="variant_id" value="{{$variant->id}}">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="{{old('price')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Is Default</label>
                    <select name="is_default" class="form-control">
                      <option value="">Select</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="">Select</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Variant Item</button>
                 </form>
            </div>
          </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){
      $('body').on('change', '.category', function(){
        let id = $(this).val();
        $.ajax({
          method:'GET',
          url:"{{route('admin.product.sub-category')}}",
          data:{
            id:id
          },
          success:function(data){
            $('.sub-category').html('<option value="">Select</option>');
            $.each(data,function(i,item){
              $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
            })
          },
          error:function(xhr,error,status){
            console.log(error) 
          }
        })
      });

      $('body').on('change', '.sub-category', function(){
        let id = $(this).val();
        $.ajax({
          method:'GET',
          url:"{{route('admin.product.child-category')}}",
          data:{
            id:id
          },
          success:function(data){
            $('.child-category').html('<option value="">Select</option>');
            $.each(data,function(i,item){
              $('.child-category').append(`<option value="${item.id}">${item.name}</option>`);
            })
          },
          error:function(xhr,error,status){
            console.log(error) 
          }
        })
      });
    })
  </script>
@endpush