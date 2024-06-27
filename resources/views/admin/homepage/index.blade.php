@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Setting</h1>
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
                <div class="row">
                    <div class="col-3">
                      <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-popular-list" data-toggle="list" href="#list-popular" role="tab">Popular Category Product</a>
                        <a class="list-group-item list-group-item-action" id="list-single-list" data-toggle="list" href="#list-single" role="tab">Single Category Product</a>
                        <a class="list-group-item list-group-item-action" id="list-single-two-list" data-toggle="list" href="#list-single-two" role="tab">Single Category Two</a>
                        <a class="list-group-item list-group-item-action" id="list-single-three-list" data-toggle="list" href="#list-single-three" role="tab">Single Category Three</a>
                      </div>
                    </div>
                    <div class="col-9">
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-popular" role="tabpanel" aria-labelledby="list-popular-list">
                          <div class="card border">
                            <div class="card-header">
                              <h6>General Setting</h6>
                            </div>
                            <div class="card-body">
                              <form action="{{route('admin.homepage.popular-product.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Layout</label>
                                            <select name="cat_one" class="form-control main-category">
                                              <option value="">Select</option>
                                              @php
                                                $popular_product = json_decode($popular->value);
                                              @endphp
                                              @foreach ($categories as $category)
                                                <option {{$popular_product[0]->category == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                              @endforeach 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Layout</label>
                                            @php
                                              $sub_categories = \App\Models\SubCategory::where('category_id', $popular_product[0]->category)->get();
                                              $child_categories = \App\Models\ChildCategory::where('sub_category_id', $popular_product[0]->sub_category)->get();
                                            @endphp
                                            <select name="sub_cat_one" class="form-control sub-category">
                                              <option value="">Select</option>
                                              @foreach ($sub_categories as $sub_category)
                                              <option {{$popular_product[0]->sub_category == $sub_category->id ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Layout</label>
                                            <select name="child_cat_one" class="form-control child-category">
                                              <option value="">Select</option>
                                              @foreach ($child_categories as $child_category)
                                              <option {{$popular_product[0]->child_category == $child_category->id ? 'selected' : ''}} value="{{$child_category->id}}">{{$child_category->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="cat_two" class="form-control main-category">
                                            <option value="">Select</option>
                                            @php
                                              $popular_product = json_decode($popular->value);
                                            @endphp
                                            @foreach ($categories as $category)
                                              <option {{$popular_product[1]->category == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          @php
                                            $sub_categories = \App\Models\SubCategory::where('category_id', $popular_product[1]->category)->get();
                                            $child_categories = \App\Models\ChildCategory::where('sub_category_id', $popular_product[1]->sub_category)->get();
                                          @endphp
                                          <select name="sub_cat_two" class="form-control sub-category">
                                            <option value="">Select</option>
                                            @foreach ($sub_categories as $sub_category)
                                            <option {{$popular_product[1]->sub_category == $sub_category->id ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="child_cat_two" class="form-control child-category">
                                            <option value="">Select</option>
                                            @foreach ($child_categories as $child_category)
                                            <option {{$popular_product[1]->child_category == $child_category->id ? 'selected' : ''}} value="{{$child_category->id}}">{{$child_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="cat_three" class="form-control main-category">
                                            <option value="">Select</option>
                                            @php
                                              $popular_product = json_decode($popular->value);
                                            @endphp
                                            @foreach ($categories as $category)
                                              <option {{$popular_product[2]->category == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          @php
                                            $sub_categories = \App\Models\SubCategory::where('category_id', $popular_product[2]->category)->get();
                                            $child_categories = \App\Models\ChildCategory::where('sub_category_id', $popular_product[2]->sub_category)->get();
                                          @endphp
                                          <select name="sub_cat_three" class="form-control sub-category">
                                            <option value="">Select</option>
                                            @foreach ($sub_categories as $sub_category)
                                            <option {{$popular_product[2]->sub_category == $sub_category->id ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="child_cat_three" class="form-control child-category">
                                            <option value="">Select</option>
                                            @foreach ($child_categories as $child_category)
                                            <option {{$popular_product[2]->child_category == $child_category->id ? 'selected' : ''}} value="{{$child_category->id}}">{{$child_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="cat_four" class="form-control main-category">
                                            <option value="">Select</option>
                                            @php
                                              $popular_product = json_decode($popular->value);
                                            @endphp
                                            @foreach ($categories as $category)
                                              <option {{$popular_product[3]->category == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          @php
                                            $sub_categories = \App\Models\SubCategory::where('category_id', $popular_product[3]->category)->get();
                                            $child_categories = \App\Models\ChildCategory::where('sub_category_id', $popular_product[3]->sub_category)->get();
                                          @endphp
                                          <select name="sub_cat_four" class="form-control sub-category">
                                            <option value="">Select</option>
                                            @foreach ($sub_categories as $sub_category)
                                            <option {{$popular_product[3]->sub_category == $sub_category->id ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="child_cat_four" class="form-control child-category">
                                            <option value="">Select</option>
                                            @foreach ($child_categories as $child_category)
                                            <option {{$popular_product[3]->child_category == $child_category->id ? 'selected' : ''}} value="{{$child_category->id}}">{{$child_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="list-single" role="tabpanel" aria-labelledby="list-single-list">
                          <div class="card border">
                            <div class="card-header">
                              <h6>Single Category Product Setting</h6>
                            </div>
                            <div class="card-body">
                              <form action="{{route('admin.homepage.single-category-product.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                               
                                <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="single_cat" class="form-control main-category">
                                            <option value="">Select</option>
                                            @php
                                              $single_category_product = json_decode($single_category->value);    
                                            @endphp
                                            @foreach ($categories as $category)
                                              <option {{$single_category_product->category == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          @php
                                            $sub_categories = \App\Models\SubCategory::where('category_id', $single_category_product->category)->get();
                                            $child_categories = \App\Models\ChildCategory::where('sub_category_id', $single_category_product->sub_category)->get();
                                          @endphp
                                          <select name="single_sub_cat" class="form-control sub-category">
                                            <option value="">Select</option>
                                            @foreach ($sub_categories as $sub_category)
                                            <option {{$single_category_product->sub_category == $sub_category->id ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="single_child_cat" class="form-control child-category">
                                            <option value="">Select</option>
                                            @foreach ($child_categories as $child_category)
                                            <option {{$single_category_product->child_category == $child_category->id ? 'selected' : ''}} value="{{$child_category->id}}">{{$child_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="list-single-two" role="tabpanel" aria-labelledby="list-single-two-list">
                          <div class="card border">
                            <div class="card-header">
                              <h6>Single Category Two Product Setting</h6>
                            </div>
                            <div class="card-body">
                              <form action="{{route('admin.homepage.single-category-two-product.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                               
                                <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="single_cat" class="form-control main-category">
                                            <option value="">Select</option>
                                            @php
                                              $single_category_two_product = json_decode($single_category_two->value);    
                                            @endphp
                                            @foreach ($categories as $category)
                                              <option {{$single_category_two_product->category == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          @php
                                            $sub_categories = \App\Models\SubCategory::where('category_id', $single_category_two_product->category)->get();
                                            $child_categories = \App\Models\ChildCategory::where('sub_category_id', $single_category_two_product->sub_category)->get();
                                          @endphp
                                          <select name="single_sub_cat" class="form-control sub-category">
                                            <option value="">Select</option>
                                            @foreach ($sub_categories as $sub_category)
                                            <option {{$single_category_two_product->sub_category == $sub_category->id ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="single_child_cat" class="form-control child-category">
                                            <option value="">Select</option>
                                            @foreach ($child_categories as $child_category)
                                            <option {{$single_category_two_product->child_category == $child_category->id ? 'selected' : ''}} value="{{$child_category->id}}">{{$child_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="list-single-three" role="tabpanel" aria-labelledby="list-single-three-list">
                          <div class="card border">
                            <div class="card-header">
                              <h6>Single Category Two Product Setting</h6>
                            </div>
                            <div class="card-body">
                              <form action="{{route('admin.homepage.single-category-three-product.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                               <p>Part 1</p>
                                <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="single_cat_one" class="form-control main-category">
                                            <option value="">Select</option>
                                            
                                            @php
                                               $single_category_three_product = json_decode($single_category_three->value);  
                                              
                                            @endphp
                                             
                                            @foreach ($categories as $category)
                                              <option {{$single_category_three_product[0]->category == $category->id ? 'selected' : ''}}  value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          @php
                                            $sub_categories = \App\Models\SubCategory::where('category_id', $single_category_three_product[0]->category)->get();
                                            $child_categories = \App\Models\ChildCategory::where('sub_category_id', $single_category_three_product[0]->sub_category)->get(); 
                                          @endphp
                                          <select name="single_sub_cat_one" class="form-control sub-category">
                                            <option value="">Select</option>
                                            @foreach ($sub_categories as $sub_category)
                                            <option {{$single_category_three_product[0]->sub_category == $sub_category->id ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="">Layout</label>
                                          <select name="single_child_cat_one" class="form-control child-category">
                                            <option value="">Select</option>
                                            @foreach ($child_categories as $child_category)
                                            <option {{$single_category_three_product[0]->child_category == $child_category->id ? 'selected' : ''}} value="{{$child_category->id}}">{{$child_category->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <p>Part 2</p>
                              <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Layout</label>
                                        <select name="single_cat_two" class="form-control main-category">
                                          <option value="">Select</option>
                                          @foreach ($categories as $category)
                                            <option {{$single_category_three_product[0]->category == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                          @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Layout</label>
                                        @php
                                          $sub_categories = \App\Models\SubCategory::where('category_id', $single_category_three_product[0]->category)->get();
                                          $child_categories = \App\Models\ChildCategory::where('sub_category_id', $single_category_three_product[0]->sub_category)->get();
                                        @endphp
                                        <select name="single_sub_cat_two" class="form-control sub-category">
                                          <option value="">Select</option>
                                          @foreach ($sub_categories as $sub_category)
                                          <option {{$single_category_three_product[0]->sub_category == $sub_category->id ? 'selected' : ''}} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Layout</label>
                                        <select name="single_child_cat_two" class="form-control child-category">
                                          <option value="">Select</option>
                                         @foreach ($child_categories as $child_category)
                                          <option {{$single_category_two_product[0]->child_category == $child_category->id ? 'selected' : ''}} value="{{$child_category->id}}">{{$child_category->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
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
        let row = $(this).closest('.row');
        $.ajax({
          method:'GET',
          url:'{{route("admin.product.sub-category")}}',
          data:{
            id:id
          },
          success:function(data){
            let selector = row.find('.sub-category')
            selector.html('<option value="">Select</option>');
           $.each(data, function(i,item){
            selector.append(`<option value="${item.id}">${item.name}</option>`);
           })
          },
          error:function(error){
               console.log(error)
          }
        })
      })

    $('body').on('change', '.sub-category', function(){
      let id = $(this).val();
      let row = $(this).closest('.row');
      $.ajax({
        method:'GET',
        url:'{{route('admin.product.child-category')}}',
        data:{
          id:id
        },
        success:function(data){
          let selector = row.find('.child-category')
         selector.html('<option value="">Select</option>')
         $.each(data, function(i,item){
          selector.append(`<option value="${item.id}">${item.name}</option>`)
         })
        },
        error:function(){}
      })
    })
    })
  </script>
@endpush