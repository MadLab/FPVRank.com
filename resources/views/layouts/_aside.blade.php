 <!-- .aside-content -->
 <div class="aside-content">
     <!-- .aside-header -->
     <header class="aside-header d-block d-md-none">
         @auth
         <!-- .btn-account -->
         <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
             <span class="account-icon">
                 <span class="fa fa-caret-down fa-lg"></span>
             </span>
             <span class="account-summary">
                 <span class="account-name">{{ Auth::user()->name }}</span>
                 <span class="account-description"></span>
             </span>
         </button>
         <!-- /.btn-account -->

         <!-- .dropdown-aside -->
         <div id="dropdown-aside" class="dropdown-aside collapse">
             <!-- dropdown-items -->
             <div class="pb-3">
                 <a class="dropdown-item" href="{{route('profile.edit')}}"><span
                         class="dropdown-icon oi oi-person"></span> Profile</a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                     <span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
             </div>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
             <!-- /dropdown-items -->
         </div>
         <!-- /.dropdown-aside -->
         @else

         <a class="btn-account" href="{{route('login')}}">
             <span class="account-summary">
                 <span class="account-name">Login</span>
                 <span class="account-description"></span>
             </span>
         </a>

         @endauth
     </header>
     <!-- /.aside-header -->

     <!-- .aside-menu -->
     <section class="aside-menu perfect-scrollbar">
         <!-- .stacked-menu -->
         <nav id="stacked-menu" class="stacked-menu">
             <!-- .menu -->
             <ul class="menu">
                 <li class="menu-header">Welcome</li>
                 <!-- .menu-item -->
                 <li class="menu-item">
                     <a href="{{route('welcome.index')}}" class="menu-link">
                         <span class="menu-icon fa fa-chart-bar"></span>
                         <span class="menu-text">Rankings</span>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{route('welcome.event')}}" class="menu-link">
                         <span class="menu-icon fa fa-calendar-alt"></span>
                         <span class="menu-text">Events</span>
                     </a>
                 </li>
                 <!-- /.menu-item -->
             </ul>
             <!-- /.menu -->
             @auth
             <!-- .menu -->
             <ul class="menu">
                 <li class="menu-header">Administration</li>
                 <!-- .menu-item -->
                 <li class="menu-item">
                     <a href="{{route('home')}}" class="menu-link">
                         <span class="menu-icon fa fa-bars"></span>
                         <span class="menu-text">Dashboard</span>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{route('user.index')}}" class="menu-link">
                         <span class="menu-icon fa fa-user-cog"></span>
                         <span class="menu-text">Users</span>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{route('class.index')}}" class="menu-link">
                         <span class="menu-icon fa fa-dot-circle"></span>
                         <span class="menu-text">Classes</span>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{route('pilot.index')}}" class="menu-link">
                         <span class="menu-icon fa fa-user-astronaut"></span>
                         <span class="menu-text">Pilots</span>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{route('event.index')}}" class="menu-link">
                         <span class="menu-icon fa fa-calendar"></span>
                         <span class="menu-text">Events</span>
                     </a>
                 </li>
                 <!-- /.menu-item -->
             </ul>
             <!-- /.menu -->

             @endauth
         </nav>
         <!-- /.stacked-menu -->
     </section>
     <!-- /.aside-menu -->
 </div>
 <!-- /.aside-content -->