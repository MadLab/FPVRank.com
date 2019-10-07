  <!-- .top-bar -->
  <div class="top-bar">
      <!-- .top-bar-brand -->
      <div class="top-bar-brand">
          <a href="/">
              <img src="assets/images/brand.png" height="32px" alt="">
              Fpvrank
          </a>
      </div>
      <!-- /.top-bar-brand -->

      <!-- .top-bar-list -->
      <div class="top-bar-list">
          <!-- .top-bar-item -->
          <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
              <!-- toggle menu -->
              <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="Menu" aria-controls="navigation">
                  <span class="hamburger-box">
                      <span class="hamburger-inner"></span>
                  </span>
              </button>
              <!-- /toggle menu -->
          </div>
          <!-- /.top-bar-item -->

          <!-- .top-bar-item -->
          <div class="top-bar-item top-bar-item-full">
              <!-- .top-bar-search -->
              <div class="top-bar-search">
                  <div class="input-group input-group-search">
                      <div class="input-group-prepend">
                          <span class="input-group-text">
                              <span class="oi oi-magnifying-glass"></span>
                          </span>
                      </div>
                      {{$searchBar}}
                  </div>
              </div>
              <!-- /.top-bar-search -->
          </div>
          <!-- /.top-bar-item -->

          <!-- .top-bar-item -->
          <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
              @if(Route::currentRouteName() == 'welcome.event')
              <ul class="header-nav nav">
                  @include('event_public._searchform')
              </ul>
              @endif
              @guest
              <!-- .nav -->
              <ul class="header-nav nav">
                  <!-- .nav-item -->
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">
                          <span class="oi oi-account-login"></span>
                          {{ __('Login') }}
                      </a>
                  </li>
                  <!-- /.nav-item -->
              </ul>
              <!-- /.nav -->
              @else
              <!-- .btn-account -->
              <div class="dropdown">
                  <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="account-summary pr-lg-4 d-none d-lg-block">
                          <span class="account-name">{{ Auth::user()->name }}</span>
                          <span class="account-description"></span>
                      </span>
                  </button>
                  <!-- .dropdown-menu -->
                  <div class="dropdown-menu">
                      <div class="dropdown-arrow"></div>
                      <h6 class="dropdown-header d-none d-md-block d-lg-none">{{ Auth::user()->name }}</h6>
                      <a class="dropdown-item" href="{{route('profile.edit')}}"><span class="dropdown-icon oi oi-person"></span> Profile</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                          <span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
                  </div>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  <!-- /.dropdown-menu -->
              </div>
              <!-- /.btn-account -->

              @endguest
          </div>
          <!-- /.top-bar-item -->
      </div>
      <!-- /.top-bar-list -->
  </div>
