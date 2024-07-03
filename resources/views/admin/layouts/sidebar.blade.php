<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <ul class="sidebar-menu">  
        <li class="dropdown {{setActive(['admin.category.*', 'admin.sub-category.*','admin.child-category.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Category</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive(['admin.category.index'])}}"><a class="nav-link" href="{{route('admin.category.index')}}">Show Category</a></li>
            <li class="{{setActive(['admin.category.create'])}}"><a class="nav-link" href="{{route('admin.category.create')}}">Create Category</a></li>
            <li class="{{setActive(['admin.sub-category.index'])}}"><a class="nav-link" href="{{route('admin.sub-category.index')}}">Show Sub Category</a></li>
            <li class="{{setActive(['admin.sub-category.create'])}}"><a class="nav-link" href="{{route('admin.sub-category.create')}}">Create Sub Category</a></li>
            <li class="{{setActive(['admin.child-category.index'])}}"><a class="nav-link" href="{{route('admin.child-category.index')}}">Show Child Category</a></li>
            <li class="{{setActive(['admin.child-category.create'])}}"><a class="nav-link" href="{{route('admin.child-category.create')}}">Create Child Category</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.brand.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Brand</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.brand.index')}}">Show</a></li>
            <li><a class="nav-link" href="{{route('admin.brand.create')}}">Create</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.product.*','admin.seller-product.*','admin.pending-product.*','admin.flash-product.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Product</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive(['admin.product.index'])}}"><a class="nav-link" href="{{route('admin.product.index')}}">Show Product</a></li>
            <li class="{{setActive(['admin.product.index'])}}"><a class="nav-link" href="{{route('admin.product.create')}}">Create Product</a></li>
            <li class="{{setActive(['admin.seller-product.index'])}}"><a class="nav-link" href="{{route('admin.seller-product.index')}}">Show Seller Product</a></li>
            <li class="{{setActive(['admin.pending-product.index'])}}"><a class="nav-link" href="{{route('admin.pending-product.index')}}">Show Pending Product</a></li>
            <li class="{{setActive(['admin.flash-sale-product.index'])}}"><a class="nav-link" href="{{route('admin.flash-sale-product.index')}}">Show Flash Product</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.vendor-profile.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Vendor</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.vendor-profile.index')}}">Create</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.slider.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Home Page</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.homepage.index')}}">Index</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.slider.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Slider</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.slider.index')}}">Show</a></li>
            <li><a class="nav-link" href="{{route('admin.slider.create')}}">Create</a></li>
          </ul>
        </li>
        <li><a class="nav-link" href="{{route('admin.coupon.index')}}"><i class="far fa-square"></i> <span>Coupon</span></a></li>
        
        <li><a class="nav-link" href="{{route('admin.shipping-rule.index')}}"><i class="far fa-square"></i> <span>Shipping Rule</span></a></li>

        <li><a class="nav-link" href="{{route('admin.setting.index')}}"><i class="far fa-square"></i> <span>General Setting</span></a></li>

        <li><a class="nav-link" href="{{route('admin.payment.index')}}"><i class="far fa-square"></i> <span>Payment Setting</span></a></li>
       
        <li class="dropdown {{setActive(['admin.order.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Order</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.order.index')}}">Show</a></li>
            <li><a class="nav-link" href="{{route('admin.order.pending')}}">All Pending</a></li>
            <li><a class="nav-link" href="{{route('admin.order.processed')}}">All Processed</a></li>
            <li><a class="nav-link" href="{{route('admin.order.dropped')}}">All Dropped</a></li>
            <li><a class="nav-link" href="{{route('admin.order.shipped')}}">All Shipped</a></li>
            <li><a class="nav-link" href="{{route('admin.order.out-delivered')}}">All Out of Delivered</a></li>
            <li><a class="nav-link" href="{{route('admin.order.delivered')}}">All Delivered</a></li>
          </ul>
        </li>
        <li><a class="nav-link" href="{{route('admin.transaction.index')}}"><i class="far fa-square"></i> <span>Transaction</span></a></li>
        <li class="dropdown {{setActive(['admin.slider.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Footer</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.footer-info.index')}}">Create Footer Info</a></li>
            <li><a class="nav-link" href="{{route('admin.footer-social.index')}}">Social Link</a></li>
            <li><a class="nav-link" href="{{route('admin.footer-grid-two.index')}}">Grid Two</a></li>
            <li><a class="nav-link" href="{{route('admin.footer-grid-three.index')}}">Grid Three</a></li>
          </ul>
        </li>
        <li><a class="nav-link" href="{{route('admin.newsletter-subscriber.index')}}"><i class="far fa-square"></i> <span>Newsletter Subscriber</span></a></li>
        <li><a class="nav-link" href="{{route('admin.advertisement')}}"><i class="far fa-square"></i> <span>Advertise Banner</span></a></li>
        <br>
        <br>
        <br>
        <hr>
        
       {{--  <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
            <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
            <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
          </ul>
        </li>
        <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>  --}}  
      </ul> 
     </aside>
  </div>