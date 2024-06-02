<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
       
        <li class="dropdown {{setActive(['admin.category.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Category</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive(['admin.category.index'])}}"><a class="nav-link" href="{{route('admin.category.index')}}">Show</a></li>
            <li class="{{setActive(['admin.category.create'])}}"><a class="nav-link" href="{{route('admin.category.create')}}">Create</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.sub-category.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Sub Category</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.sub-category.index')}}">Show</a></li>
            <li><a class="nav-link" href="{{route('admin.sub-category.create')}}">Create</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.child-category.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Child Category</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.child-category.index')}}">Show</a></li>
            <li><a class="nav-link" href="{{route('admin.child-category.create')}}">Create</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.brand.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Brand</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.brand.index')}}">Show</a></li>
            <li><a class="nav-link" href="{{route('admin.brand.create')}}">Create</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.product.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Product</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.product.index')}}">Show</a></li>
            <li><a class="nav-link" href="{{route('admin.product.create')}}">Create</a></li>
          </ul>
        </li><li class="dropdown {{setActive(['admin.product.seller-product*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Seller Product</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.seller-product.index')}}">Show</a></li>
          </ul>
        </li>
      </li><li class="dropdown {{setActive(['admin.product.pending-product*'])}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Pending Product</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{route('admin.pending-product.index')}}">Show</a></li>
        </ul>
      </li>
        <li class="dropdown {{setActive(['admin.vendor-profile.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Vendor</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.vendor-profile.index')}}">Create</a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive(['admin.slider.*'])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Slider</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.slider.index')}}">Show</a></li>
            <li><a class="nav-link" href="{{route('admin.slider.create')}}">Create</a></li>
          </ul>
        </li>
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