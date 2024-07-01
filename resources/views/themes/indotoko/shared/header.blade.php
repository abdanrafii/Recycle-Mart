<nav class="navbar navbar-expand-lg bg-light fixed-top py-4 shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Recycle<span>Mart</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-flex w-100">
              <div class="col-sm-6 justify-content-center mx-auto px-0" style="">
                  <form action="{{ route('products.index') }}" class="w-100">
                      <div class="input-group mr-3 mt-10 mt-lg-0" style="max-width: 800px; width:100%">
                          <input type="text" name="keyword" class="form-control" placeholder="Mau cari apa?" aria-label="Mau cari apa?" aria-describedby="button-addon2" @if (request('keyword')) value="{{ request('keyword') }}" @endif>
                          <button class="btn btn-outline-warning" type="submit" id="button-addon2"><i class="bx bx-search"></i></button>
                      </div>
                  </form>
              </div>
            <ul class="navbar-nav ms-auto mt-3 mt-sm-0">
              <li class="nav-item me-3">
                <a class="nav-link" href="#">
                  <i class='bx bx-store'></i>
                  {{-- <span class="badge text-bg-warning rounded-circle position-absolute">2</span> --}}
                </a>
              </li>
              <li class="nav-item me-5">
                <a class="nav-link" href="{{ route('carts.index') }}">
                  <i class='bx bx-cart-alt'></i>
                  <span class="badge text-bg-warning rounded-circle position-absolute">1</span>
                </a>
              </li>
              
              @guest
                  @if (Route::has('login'))
                    <li class="nav-item mt-5 mt-lg-0 text-center">
                      <a class="nav-link btn-second me-lg-3" href="{{ route('login') }}">Login</a>
                    </li>
                  @endif

                  @if (Route::has('register'))
                    <li class="nav-item mt-3 mt-lg-0 text-center">
                      <a class="nav-link btn-first" href="{{ route('register') }}">Register</a>
                    </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
            </ul>
          </div>
        </div>
    </nav>