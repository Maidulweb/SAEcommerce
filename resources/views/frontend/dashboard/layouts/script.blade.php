<!--jquery library js-->
<script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
<!--bootstrap js-->
<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<!--font-awesome js-->
<script src="{{asset('frontend/js/Font-Awesome.js')}}"></script>
<!--select2 js-->
<script src="{{asset('frontend/js/select2.min.js')}}"></script>
<!--slick slider js-->
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<!--simplyCountdown js-->
<script src="{{asset('frontend/js/simplyCountdown.js')}}"></script>
<!--product zoomer js-->
<script src="{{asset('frontend/js/jquery.exzoom.js')}}"></script>
<!--nice-number js-->
<script src="{{asset('frontend/js/jquery.nice-number.min.js')}}"></script>
<!--counter js-->
<script src="{{asset('frontend/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.countup.min.js')}}"></script>
<!--add row js-->
<script src="{{asset('frontend/js/add_row_custon.js')}}"></script>
<!--multiple-image-video js-->
<script src="{{asset('frontend/js/multiple-image-video.js')}}"></script>
<!--sticky sidebar js-->
<script src="{{asset('frontend/js/sticky_sidebar.js')}}"></script>
<!--price ranger js-->
<script src="{{asset('frontend/js/ranger_jquery-ui.min.js')}}"></script>
<script src="{{asset('frontend/js/ranger_slider.js')}}"></script>
<!--isotope js-->
<script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
<!--venobox js-->
<script src="{{asset('frontend/js/venobox.min.js')}}"></script>
<!--classycountdown js-->
<script src="{{asset('frontend/js/jquery.classycountdown.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!--main/custom js-->
<script src="{{asset('frontend/js/main.js')}}"></script>

<script>
 @if (Session::has('message'))
 var type = "{{ Session::get('alert-type', 'info') }}"
 switch (type) {
            case 'info':
            toastr.options.timeOut = 5000;
            toastr.info("{{ Session::get('message') }}");
            /* var audio = new Audio('audio.mp3');
            audio.play(); */
            break;
            case 'success':
            toastr.options.timeOut = 5000;
            toastr.success("{{ Session::get('message') }}");
            break;
            case 'warning':
            toastr.options.timeOut = 5000;
            toastr.warning("{{ Session::get('message') }}");
            break;
            case 'error':
            toastr.options.timeOut = 5000;
            toastr.error("{{ Session::get('message') }}");
             break;
 }
@endif
</script>