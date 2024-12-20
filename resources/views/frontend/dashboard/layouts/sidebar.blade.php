<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
      <li><a class="active" href="{{url('/')}}"><i class="fas fa-tachometer"></i>Home</a></li>
      <li><a href="{{route('user.messenger.index')}}"><i class="fas fa-list-ul"></i> Messenger</a></li>
      <li><a href="{{route('user.order.index')}}"><i class="fas fa-list-ul"></i> Orders</a></li>
      <li><a href="{{route('user.product-review.index')}}"><i class="far fa-star"></i> Reviews</a></li>
      <li><a href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li>
      <li><a href="{{route('user.profile')}}"><i class="far fa-user"></i> My Profile</a></li>
      <li><a href="{{route('user.user-address.index')}}"><i class="fal fa-gift-card"></i> Addresses</a></li>
      @if (auth()->user()->role == 'user')
      <li><a href="{{route('vendor.request-page')}}"><i class="fal fa-gift-card"></i> Request To Be Vendor</a></li>
      @elseif (auth()->user()->role == 'vendor')
      <li><a href="{{route('vendor.dashboard')}}"><i class="fal fa-gift-card"></i> Go To Vendor Dashboard</a></li>
      @endif
      <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="far fa-sign-out-alt"></i> Log Out
            </a>
        </form>
    </li>
    </ul>
  </div>