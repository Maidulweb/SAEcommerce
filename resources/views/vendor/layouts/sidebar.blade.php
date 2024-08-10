<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
    
      <li><a href="{{route('vendor.messenger.index')}}"><i class="far fa-user"></i> Messenger</a></li>
      <li><a href="{{route('vendor.shop-profile.index')}}"><i class="far fa-user"></i> Shop Proile</a></li>
      <li><a href="{{route('vendor.profile')}}"><i class="far fa-user"></i> My Proile</a></li>
      <li><a href="{{route('vendor.order.index')}}"><i class="far fa-user"></i>Order Product</a></li>
      <li><a href="{{route('vendor.product-review.index')}}"><i class="far fa-user"></i>Product Review</a></li>
      <li><a href="{{route('vendor.withdraw.index')}}"><i class="far fa-user"></i>Withdraw</a></li>
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