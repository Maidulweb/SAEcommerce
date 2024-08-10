@php
$single_category_two_products = json_decode($singleCategoryTwo->value);
$lastkey = [];
foreach ($single_category_two_products as $key => $item) {
   if ($item == null) {
    break;
   }
   $lastkey = [$key => $item];
 }

 if (array_keys($lastkey)[0] == 'category') {
     $category = \App\Models\Category::find($lastkey['category']);
     $products = \App\Models\Product::withAvg('productReview', 'rating')->withCount('productReview')
                        ->with(['productImagegallery','category','productVariant'])->where('category_id', $category->id)->take(4)->orderBy('id', 'DESC')->get();
 }elseif(array_keys($lastkey)[0] == 'sub_category'){
     $category = \App\Models\SubCategory::find($lastkey['sub_category']);
     $products = \App\Models\Product::withAvg('productReview', 'rating')->withCount('productReview')
                        ->with(['productImagegallery','category','productVariant'])->where('sub_category_id', $category->id)->take(4)->orderBy('id', 'DESC')->get();
 }else{
     $category = \App\Models\ChildCategory::find($lastkey['child_category']);
     $products = \App\Models\Product::withAvg('productReview', 'rating')->withCount('productReview')
                        ->with(['productImagegallery','category','productVariant'])->where('child_category_id', $category->id)->take(4)->orderBy('id', 'DESC')->get();
 }

@endphp
<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{$category->name}}</h3>
                    <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
        
@foreach ($products as $key => $product)
<x-product-card :product='$product' />
@endforeach
        </div>
    </div>
</section>