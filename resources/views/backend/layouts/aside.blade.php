<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link elevation-4 mb-3">
      <img src="{{url('images/logo.png')}}" alt="Site- Logo" style="width:100%;background-color:#fff">
      {{-- <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      {{-- <span class="brand-text font-weight-light">Niveshaay</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-4">
      <!-- Sidebar user (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Welcome, {{Auth::user()->name}}</a>
        </div>
      </div> --}}

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-5 pb-3 pt-3">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('admin.home')}}" class="nav-link @if($active=='dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul> --}}
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.showchangepassword')}}" class="nav-link @if($active =='change-password') active @endif">
              <i class="fas fa-key nav-icon"></i>
              <p>Change Password</p>
            </a>
          </li>
          <li class="nav-item">
                <a href="{{route('admin.admin-users')}}" class="nav-link @if($active =='admin') active @endif">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Admin Users</p>
                </a>
          </li>
          
          <li class="nav-item @if($active =='users' || $active=='excel') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Management
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.users')}}" class="nav-link @if($active =='users') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('import-excel')}}" class="nav-link @if($active=='excel') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bulk users import</p>
                </a>
              </li>
              
            </ul>
            
          </li>
          {{-- <li class="nav-item">
                <a href="{{route('admin.research')}}" class="nav-link @if($active=='research') active @endif">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Our Research</p>
                </a>
            </li> --}}
            <li class="nav-item">
                <a href="{{route('admin.contacts')}}" class="nav-link @if($active=='contact') active @endif">
                  <i class="fas fa-address-book nav-icon"></i>
                  <p>Contact us</p>
                </a>
            </li>
          <li class="nav-item">
                <a href="{{route('admin.share')}}" class="nav-link @if($active=='share') active @endif">
                  <i class="fas fa-search nav-icon"></i>
                  <p>Research Reports</p>
                </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.subscription-details')}}" class="nav-link @if($active=='subscription-details') active @endif">
                <i class="fas fa-rocket nav-icon"></i>
                <p>Subscription Details</p>
              </a>
            </li>
            <li class="nav-item @if($active =='current-month' || $active=='monthly' || $active=='annually') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Complaint Status
                  <i class="fas fa-angle-left right"></i>
                  
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.currentmonthcomplaint')}}" class="nav-link @if($active =='current-month') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Current Month</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.monthlycomplaint')}}" class="nav-link @if($active =='monthly') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Monthly</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.anuallycomplaint')}}" class="nav-link @if($active=='annually') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Annually</p>
                  </a>
                </li>
                
              </ul>
              
            </li>
            <li class="nav-item">
              <a href="{{route('admin.our-clients')}}" class="nav-link @if($active=='clients') active @endif">
                <i class="fas fa-user nav-icon"></i>
                <p>Client Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.featured-on')}}" class="nav-link @if($active=='featured-on') active @endif">
                <i class="fas fa-book nav-icon"></i>
                <p>Featured On</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.tweeter-feeds')}}" class="nav-link @if($active=='tweeter-feeds') active @endif">
                <i class="fab fa-twitter nav-icon"></i>
                <p>Twiter Feed</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.report-images')}}" class="nav-link @if($active=='research_image') active @endif">
                <i class="fas fa-image nav-icon"></i>
                <p>Images Library</p>
              </a>
            </li>
            <li class="nav-item @if($active=='newsletterusers' || $active == 'newsletters' || $active == 'sendnewsletter' || $active=='bulknewsletterusers') menu-is-opening menu-open @endif">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>
                  Newsletter Management
                  <i class="fas fa-angle-left right"></i>
                  
                </p>
              </a>
              <ul class="nav nav-treeview @if($active=='newsletterusers') active @endif">
                <li class="nav-item">
                  <a href="{{ route('admin.newsletter.users')}}" class="nav-link @if($active=='newsletterusers') active @endif" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Subscribed Users
                    </p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="{{ route('admin.newsletter.bulk.user')}}" class="nav-link @if($active=='bulknewsletterusers') active @endif" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bulk Subscribed Users
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.newsletter')}}" class="nav-link @if($active=='newsletters') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Newsletter template</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.newsletter.send')}}" class="nav-link @if($active == 'sendnewsletter') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Send Newsletter
                    </p>
                  </a>
                </li>
                
              </ul>
              
            </li>
            <li class="nav-item">
              
              <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
              
              <form action="{{route('logout')}}" method="POST" id="logout-form">
                @csrf
                {{-- <button type="submit"><i class="fas fa-sign-out-alt nav-link"></i> Logout</button> --}}
              </form>
              
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
