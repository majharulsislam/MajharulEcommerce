<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="{{ route('index') }}" style="color:#e4ff00">Majharul 2.0 Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Route::is('products') ? 'active' : '' }}" aria-current="page" href="{{ route('products') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1">Contact</a>
        </li>

        <li class="nav-item">
         {{-- Search form --}}
          <form action="{{ route('product.search') }}" method="GET" class="d-flex">
            @csrf
            <div class="input-group">
              <input type="text" name="searching" class="form-control" placeholder="Search Product">
              <button class="btn btn-outline-secondary bg-dark" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">

          <!-- Authentication Links -->
          @guest
              @if (Route::has('login'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
              @endif

              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item dropdown">
                  
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" v-pre>
                    <img class="gravatar_image" src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" alt="Gravatar Image">
                    {{ Auth::user()->first_name.' '.Auth::user()->last_name }}
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                          {{ __('My Dashboard') }}
                      </a>

                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest

          {{-- Cart Product --}}
          <li class="nav-item">
              <a class="nav-link" href="{{ route('carts.index') }}">
                <span class="badge bg-danger" id="totalitems">
                  <i class="fas fa-cart-plus"></i> - {{ App\Models\Cart::totalCarts() }}
                </span>
              </a>
          </li>
      </ul>

    </div>
  </div>
</nav>