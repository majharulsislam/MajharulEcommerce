<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="profile-image">
            <img class="img-xs rounded-circle" src="{{ asset('backend/img/faces') }}/face8.jpg" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>
          <div class="text-wrapper">
            <p class="profile-name">Majharul Islam</p>
            <p class="designation">Premium user</p>
          </div>
        </a>
      </li>

      <li class="nav-item nav-category">Main Menu</li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.index') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Products</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="products">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.manageproduct') }}">Manage Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.create') }}">Add Product</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.manage.order') }}">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Manage Orders</span>
          <i class="menu-arrow"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Products Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="category">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.managecategory') }}">Manage Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.category.create') }}">Add Category</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#brand" aria-expanded="false" aria-controls="brand">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Product Brands</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="brand">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.managebrands') }}">Manage Brands</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.brand.create') }}">Add Brand</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#division" aria-expanded="false" aria-controls="division">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Division</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="division">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.managedivision') }}">Manage Division</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.division.create') }}">Add Division</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#district" aria-expanded="false" aria-controls="district">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">District</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="district">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.managedistrict') }}">Manage District</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.district.create') }}">Add District</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.slider.index') }}">
          <i class="menu-icon typcn typcn-coffee"></i>
          <span class="menu-title">Sliders</span>
          <i class="menu-arrow"></i>
        </a>
      </li>

      <a class="nav-link" href="#">
        <form action="{{ route('admin.logout.submit') }}" method="post">
          @csrf
          <input type="submit" value="Logout" class="btn btn-lg btn-danger">
        </form>
      </a>

    </ul>
  </nav>