@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Create Product</h1>
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
                 <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Thumb Image</label>
                    <input type="file" name="thumb_image" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Brand</label>
                    <select name="brand_id" class="form-control">
                    <option value="">Select</option>
                      @foreach ($brands as $brand)
                      <option value="{{$brand->id}}">{{$brand->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control category">
                          <option value="">Select</option>
                          @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Sub Category</label>
                        <select name="sub_category_id" class="form-control sub-category">
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Child Category</label>
                        <select name="child_category_id" class="form-control child-category">
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="qty" value="{{old('qty')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Short Description</label>
                    <textarea class="form-control" name="short_description"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Long Description</label>
                    <textarea rows="1" cols="1" class="form-control summernote" name="long_description"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Video Link</label>
                    <input type="text" name="video_link" value="{{old('video_link')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>SKU</label>
                    <input type="text" name="sku" value="{{old('sku')}}" class="form-control">
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" value="{{old('price')}}" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Offer Price</label>
                        <input type="number" name="offer_price" value="{{old('offer_price')}}" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Offer Start Date</label>
                        <input type="text" name="offer_start_date" class="form-control datepicker">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Offer End Date</label>
                        <input type="text" name="offer_end_date" class="form-control datepicker">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Product Type</label>
                        <select name="product_type" class="form-control">
                          <option value="">Select</option>
                          <option value="top_product">Top</option>
                          <option value="new_product">New</option>
                          <option value="featured_product">Featured</option>
                          <option value="best_product">Best</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                          <option value="">Select</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>SEO Title</label>
                    <input type="text" name="seo_title" value="{{old('seo_title')}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>SEO Description</label>
                    <textarea name="seo_description" class="form-control">{{old('seo_description')}}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Product</button>
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