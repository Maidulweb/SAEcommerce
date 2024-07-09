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
                        <h4>blog dtails</h4>
                        <ul>
                            <li><a href="#">blog</a></li>
                            <li><a href="#">blog details</a></li>
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
        BLOGS DETAILS START
    ==============================-->
    <section id="wsus__blog_details">
        <div class="container">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-8">
                    <div class="wsus__main_blog">
                        <div class="wsus__main_blog_img">
                            <img src="{{asset($blog->image)}}" alt="blog" class="img-fluid w-100">
                        </div>
                        <p class="wsus__main_blog_header">
                            <span><i class="fas fa-user-tie"></i> by {{$blog->user->name}}</span>
                            <span><i class="fal fa-calendar-alt"></i> {{date('d M Y', strtotime($blog->created_at))}}</span>
                            <span><i class="fal fa-comment-alt-smile"></i> 0 Comment</span>
                            <span><i class="far fa-eye"></i> 11 Views</span>
                        </p>
                        <div class="wsus__description_area">
                            <h1>{{$blog->title}}</h1>
                            {!! $blog->description !!}
                        </div>
                        <div class="wsus__share_blog">
                            <p>share:</p>
                            <ul>
                                <li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
            {{--             <div class="wsus__related_post">
                            <div class="row">
                                <div class="col-xl-12">
                                    <h5>related post</h5>
                                </div>
                            </div>
                            <div class="row blog_det_slider">
                                <div class="col-xl-3">
                                    <div class="wsus__single_blog wsus__single_blog_2">
                                        <a class="wsus__blog_img" href="#">
                                            <img src="images/blog_1.jpg" alt="blog" class="img-fluid w-100">
                                        </a>
                                        <div class="wsus__blog_text">
                                            <a class="blog_top red" href="#">women's</a>
                                            <div class="wsus__blog_text_center">
                                                <a href="blog_details.html">New found the women’s shirt for summer
                                                    season</a>
                                                <p class="date">nov 04 2021</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="wsus__single_blog wsus__single_blog_2">
                                        <a class="wsus__blog_img" href="#">
                                            <img src="images/blog_2.jpg" alt="blog" class="img-fluid w-100">
                                        </a>
                                        <div class="wsus__blog_text">
                                            <a class="blog_top blue" href="#">lifestyle</a>
                                            <div class="wsus__blog_text_center">
                                                <a href="blog_details.html">Fusce lacinia arcuet nulla menasious</a>
                                                <p class="date">nov 04 2021</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="wsus__single_blog wsus__single_blog_2">
                                        <a class="wsus__blog_img" href="#">
                                            <img src="images/blog_3.jpg" alt="blog" class="img-fluid w-100">
                                        </a>
                                        <div class="wsus__blog_text">
                                            <a class="blog_top orange" href="#">lifestyle</a>
                                            <div class="wsus__blog_text_center">
                                                <a href="blog_details.html">found the men’s shirt for summer season</a>
                                                <p class="date">nov 04 2021</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="wsus__single_blog wsus__single_blog_2">
                                        <a class="wsus__blog_img" href="#">
                                            <img src="images/blog_4.jpg" alt="blog" class="img-fluid w-100">
                                        </a>
                                        <div class="wsus__blog_text">
                                            <a class="blog_top orange" href="#">fashion</a>
                                            <div class="wsus__blog_text_center">
                                                <a href="blog_details.html">winter collection for women’s</a>
                                                <p class="date">nov 04 2021</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="wsus__single_blog wsus__single_blog_2">
                                        <a class="wsus__blog_img" href="#">
                                            <img src="images/blog_5.jpg" alt="blog" class="img-fluid w-100">
                                        </a>
                                        <div class="wsus__blog_text">
                                            <a class="blog_top red" href="#">lifestyle</a>
                                            <div class="wsus__blog_text_center">
                                                <a href="blog_details.html">Comes a cool blog post with Images</a>
                                                <p class="date">nov 04 2021</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="wsus__comment_area">
                            <h4>comment <span>{{count($blog_comments)}}</span></h4>
                            @foreach ($blog_comments as $blog_comment)
                            <div class="wsus__main_comment">
                                <div class="wsus__comment_img">
                                    @if ($blog_comment->user->image)
                                    <img src="{{asset($blog_comment->user->image)}}" alt="user" class="img-fluid w-100">
                                    @else
                                    <img src="{{asset('frontend/images/client_img_1.jpg')}}" alt="user" class="img-fluid w-100">
                                    @endif
                                   
                                </div>
                                <div class="wsus__comment_text replay">
                                    <h6>{{$blog_comment->user->name}} <span>{{date('d M Y', strtotime($blog_comment->created_at))}}</span></h6>
                                    <p>{{$blog_comment->comment}}</p>
                                </div>
                            </div>
                            @endforeach
                           
                            <div id="pagination">
                                @if ($blog_comments->hasPages())
                                {{$blog_comments->withQueryString()->links()}}
                            @endif
                            </div>
                        </div>
                        <div class="wsus__post_comment">
                            <h4>post a comment</h4>
                            @if (auth()->check())
                            <form action="{{route('user.blog.comment')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__single_com">
                                            <textarea name="comment" rows="5" placeholder="Your Comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                <button class="common_btn" type="submit">post comment</button>
                            </form>
                            @else
                            <p><a href="{{route('login')}}">Login</a></p> 
                            @endif
                            
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-4">
                    <div class="wsus__blog_sidebar" id="sticky_sidebar">
                        <div class="wsus__blog_search">
                            <h4>search</h4>
                            <form action="{{route('frontend.blog-all')}}" method="GET">
                                <input type="text" name="search" placeholder="Search">
                                <button type="submit" class="common_btn"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <div class="wsus__blog_category">
                            <h4>Categories</h4>
                            <ul>
                                @foreach ($categories as $category)
                                <li><a href="{{route('frontend.blog-category-post', $category->id)}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="wsus__blog_post">
                            <h4>Popular Post</h4>
                           @foreach ($blog_mores as $blog_more)
                           <div class="wsus__blog_post_single">
                            <a href="#" class="wsus__blog_post_img">
                                <img src="{{asset($blog_more->image)}}" alt="blog" class="imgofluid w-100">
                            </a>
                            <div class="wsus__blog_post_text">
                                <a href="{{route('frontend.blog-single', $blog_more->slug)}}">{{$blog_more->title}}s</a>
                                <p> <span>{{date('d M Y', strtotime($blog_more->created_at))}} </span></p>
                            </div>
                        </div>
                           @endforeach

                        </div>
                        <div class="wsus__popular_tag">
                            <h4>popular tags</h4>
                            <ul>
                                @foreach ($categories as $category)
                                <li><a href="{{route('frontend.blog-category-post', $category->id)}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BLOGS DETAILS END
    ==============================-->
@endsection
