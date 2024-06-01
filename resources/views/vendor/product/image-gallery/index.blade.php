@extends('vendor.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
      <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="far fa-user"></i> profile</h3>
        <div class="wsus__dashboard_profile">
          <div class="wsus__dash_pro_area">
            <h4>Image Gallery</h4>
     
              <div class="row">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                 <div class="text-right">
                  <a href="{{route('vendor.product-image-gallery.index')}}">Back</a>
                 </div>
                 <form action="{{route('vendor.product-image-gallery.store')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                  <div class="form-group">
                    <label>Thumb Image</label>
                    <input multiple type="file" name="images[]" class="form-control">
                  </div>
                  <input type="hidden" name='product_id' value="{{$product->id}}">
                  <button class="btn btn-primary" type="submit">Create Image Gallery</button>
                </form>
                <div class="wsus__dash_pass_change mt-2 shop-profile">
                  {{ $dataTable->table() }}
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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