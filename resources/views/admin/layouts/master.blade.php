<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <title>SAEcommerce</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('backend/assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/summernote/summernote-bs4.css')}}">
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="{{asset('backend/assets/css/toastr.css')}}">
  {{-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css"> --}}
  <link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.min.css')}}">
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css"> --}}
  <link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-iconpicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/select2/dist/css/select2.min.css')}}" />
  

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/css/components.css')}}">
 
  <script>
    const USER = {
      id:'{{auth()->user()->id}}',
      name:'{{auth()->user()->name}}',
      image:"{{asset(auth()->user()->image)}}",
    }
  </script>

@vite(['resources/js/app.js', 'resources/js/admin.js'])
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('admin.layouts.navbar')
      @include('admin.layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2024 <div class="bullet"></div> Design By <a href="#">SAEcommerce</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('backend/assets/modules/jquery.min.js')}}"></script>
  <script src="{{asset('backend/assets/modules/popper.js')}}"></script>
  <script src="{{asset('backend/assets/modules/tooltip.js')}}"></script>
  <script src="{{asset('backend/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('backend/assets/modules/moment.min.js')}}"></script>
  <script src="{{asset('backend/assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{asset('backend/assets/modules/chart.min.js')}}"></script>
  <script src="{{asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{asset('backend/assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}
  <script src="{{asset('backend/assets/js/toastr.min.js')}}"></script>
  {{--  <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script> --}}
  <script src="{{asset('backend/assets/js/dataTables.min.js')}}"></script>
  {{-- <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script> --}}
  <script src="{{asset('backend/assets/js/dataTables.bootstrap5.js')}}"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
  <script src="{{asset('backend/assets/js/sweetalert2@11.js')}}"></script>
  <script type="text/javascript" src="{{asset('backend/assets/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
  <script src="{{asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <script src="{{asset('backend/assets/modules/select2/dist/js/select2.full.min.js')}}"></script>
  
  

  <!-- Page Specific JS File -->
  <script src="{{asset('backend/assets/js/page/index-0.js')}}"></script>
  
  <!-- Template JS File -->
  <script src="{{asset('backend/assets/js/scripts.js')}}"></script>
  <script src="{{asset('backend/assets/js/custom.js')}}"></script>
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
<script>
  $(document).ready(function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
            });
    $('body').on('click', '.delete-item', function(event){
      event.preventDefault();
     let deleteUrl = $(this).attr('href');
     Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!"
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  type:'POST',
                  url:deleteUrl,
                  data: {_method: 'DELETE'},
                  success:function(data){
                    if(data.status=='success'){
                      Swal.fire({
                      title: "Deleted!",
                      text: data.message,
                      icon: "success"
                    });
                    window.location.reload()
                    }else if(data.status == 'error'){
                      Swal.fire({
                      title: "Can't delet!",
                      text: data.message,
                      icon: "error"
                    });
                    }
                   

                  },
                  error:function(xhr,status,error){
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                  }
                })
                
              }
      });
    })  
  })
</script>
@stack('scripts')
</body>
</html>