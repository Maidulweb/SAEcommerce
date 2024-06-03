@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Show Flash Sale Product</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="section-body">
        <div class="card">
          <div class="card-body">
             <div class="form-group">
                <form action="{{route('admin.flash-sale-product.update')}}" method="POST">
                    @csrf
                    @method("PUT")
                <label>Flash Sale End Date</label>
                <input type="text" name="flash_sale_end_date" value="{{@$flash_date->flash_sale_end_date}}" class="form-control datepicker">
                <div class="mt-4">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
              </div>
          </div>
        </div>
  </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
         <p>Flash Sale Product Item</p>
         <form action="{{route('admin.flash-sale-item-product.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Add Product</label>
                <select name="product_id" class="form-control select2">
                    <option value="">Select</option>
                    @foreach ($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Show At Home</label>
                        <select name="show_at_home" class="form-control">
                          <option value="">Select</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
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
              <div>
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
         </form>
      </div>
    </div>
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

 $('body').on('click', '.status-active', function(){

  let isChecked = $(this).is(':checked');

  let id = $(this).data('id');

  $.ajax({
   method:'PUT',
   url:"{{route('admin.flash-sale-item-product.status')}}",
   data:{
    status:isChecked,
    id:id
   },
   success:function(data){
    toastr.success(data.message)
   },

   error:function(error){
   console.log(error)
   }
  })
 })
})
    </script>
@endpush

