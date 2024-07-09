@extends('frontend.layouts.master')
@section('title')
{{$setting->site_name}} - Blog
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
                        <h4>our latest blogs</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">blogs</a></li>
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
        BLOGS PAGE START
    ==============================-->
    <section id="wsus__blogs">
        <div class="container">
            <div class="row">
                @if (request()->has('search'))
                  <p>Search - {{request()->search}}</p>  
                  <hr>
                @endif
                @foreach ($blogs as $blog)
                <div class="col-xl-4 col-sm-6 col-lg-4">
                    <div class="wsus__single_blog wsus__single_blog_2">
                        <a class="wsus__blog_img" href="{{route('frontend.blog-single', $blog->id)}}">
                            <img src="{{asset($blog->image)}}" alt="blog" class="img-fluid w-100">
                        </a>
                        <div class="wsus__blog_text">
                            <a class="blog_top red" href="{{route('frontend.blog-single', $blog->id)}}">{{$blog->category->name}}</a>
                            <div class="wsus__blog_text_center">
                                <a href="blog_details.html">{{limitText($blog->title, 50)}}</a>
                                <p class="date">{{date('d M Y', strtotime($blog->created_at))}}</p>
                                <p>{{$blog->user->name}}</p>
                            </div>
                        </div>
                    </div>
                </div>    
                @endforeach
                
            </div>
            <div id="pagination">
                @if ($blogs->hasPages())
                    {{$blogs->withQueryString()->links()}}
                @endif
            </div>
        </div>
    </section>
    <!--============================
        BLOGS PAGE END
    ==============================-->
@endsection
