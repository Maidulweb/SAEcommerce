@php
    $footer_info = Cache::rememberForever('footer_info', function () {
       return \App\Models\FooterInfo::first();
    });
    $footer_socials = Cache::rememberForever('footer_socials', function () {
       return \App\Models\FooterSocial::where('status', 1)->orderBy('id', 'ASC')->get();
    });
    $footer_grid_twos = Cache::rememberForever('footer_grid_twos', function () {
       return \App\Models\FooterGridTwo::where('status', 1)->orderBy('id', 'ASC')->get();
    });
    $footer_grid_threes = Cache::rememberForever('footer_grid_threes', function () {
       return \App\Models\FooterGridThree::where('status', 1)->orderBy('id', 'ASC')->get();
    });
    $footer_grid_title = Cache::rememberForever('footer_grid_title', function () {
       return \App\Models\FooterGridTitle::first();
    });
@endphp
<footer class="footer_2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-7 col-md-6 col-lg-3">
                <div class="wsus__footer_content">
                    <a class="wsus__footer_2_logo" href="#">
                        <img src="{{asset($footer_info->logo)}}" alt="logo">
                    </a>
                    <a class="action" href="callto:+8896254857456"><i class="fas fa-phone-alt"></i>
                        {{$footer_info->phone}}</a>
                    <a class="action" href="mailto:example@gmail.com"><i class="far fa-envelope"></i>
                        {{$footer_info->email}}</a>
                    <p><i class="fal fa-map-marker-alt"></i> {{$footer_info->address}}</p>
                    <ul class="wsus__footer_social">
                        @foreach ($footer_socials as $footer_social)
                        <li><a class="facebook" href="#"><i class="{{$footer_social->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{$footer_grid_title->footer_grid_two_title}}</h5>
                    <ul class="wsus__footer_menu">
                        @foreach ($footer_grid_twos as $footer_grid_two)
                        <li><a href="{{$footer_grid_two->url}}"><i class="fas fa-caret-right"></i> {{$footer_grid_two->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{$footer_grid_title->footer_grid_three_title}}</h5>
                    <ul class="wsus__footer_menu">
                        @foreach ($footer_grid_threes as $footer_grid_three)
                        <li><a href="{{$footer_grid_three->url}}"><i class="fas fa-caret-right"></i> {{$footer_grid_three->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                <div class="wsus__footer_content wsus__footer_content_2">
                    <h3>Subscribe To Our Newsletter</h3>
                    <p>Get all the latest information on Events, Sales and Offers.
                        Get all the latest information on Events.</p>
                    <form id="newsletter" action="" method="POST">
                        @csrf
                        <input class="newsletter-email" type="email" name="email" placeholder="Email....">
                        <button type="submit" class="common_btn subscription-before-send">subscribe</button>
                    </form>
                    <div class="footer_payment">
                        <p>We're using safe payment for :</p>
                        <img src="{{asset('frontend/images/credit2.png')}}" alt="card" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__copyright d-flex justify-content-center">
                        <p>Copyright © 2021 Sazao shop. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>