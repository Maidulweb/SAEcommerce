@extends('frontend.layouts.master')
@section('title')
{{$setting->site_name}} || Vendor
@endsection

@section('content')
<!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>vendors</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">vendors</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
      VENDORS START
    ==============================-->
    <section id="wsus__product_page" class="wsus__vendors">
        <div class="container">
            <div class="row">
                @foreach ($vendors as $vendor)
                <div class="col-xl-6 col-md-6">
                    <div class="wsus__vendor_single">
                        <img src="{{asset($vendor->banner)}}" alt="vendor" class="img-fluid w-100">
                        <div class="wsus__vendor_text">
                            <div class="wsus__vendor_text_center">
                                <h4>{{$vendor->shop_name}}</h4>
                                <a href="callto:{{$vendor->phone}}"><i class="far fa-phone-alt"></i>
                                    {{$vendor->phone}}</a>
                                <a href="mailto:{{$vendor->email}}"><i class="fal fa-envelope"></i>
                                    {{$vendor->email}}</a>
                                <a href="{{route('vendor.products',$vendor->id)}}" class="common_btn">visit store</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <section id="pagination">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link page_active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
    </section>
    <!--============================
       VENDORS END
    ==============================-->
@endsection

@push('scripts')
    
@endpush