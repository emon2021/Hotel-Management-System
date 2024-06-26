 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin')}}" class="brand-link">
      <img src="{{asset('public/backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('public/backend')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('/admin')}}" class="d-block">{{auth()?->user()?->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{url('/admin')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
          <li class="nav-item @if(Request::url() == route('admin.rooms.category.create') || Request::url() == route('room.index') || Request::url() == route('admin.rooms.category.index') || Request::url() == route('amenity.index')) menu-is-opening menu-open @endif">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Rooms Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Settings</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Coupons</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ route('amenity.index') }}" class="nav-link @if(Request::url() == route('amenity.index')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Amenities</p>
                </a>
              </li>
              <li class="nav-item @if(Request::url() == route('admin.rooms.category.create') || Request::url() == route('admin.rooms.category.index')) menu-is-opening menu-open @endif">
                <a href="#" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                  <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item  ">
                    <a href="{{ route('admin.rooms.category.index') }}" class="nav-link @if(Request::url() == route('admin.rooms.category.index')) active @endif">
                      <i class="far fa-double-circle nav-icon"></i>
                      <p>All Category</p>
                    </a>
                  </li>
                  <li class="nav-item  ">
                    <a href="{{ route('admin.rooms.category.create') }}" class="nav-link @if(Request::url() == route('admin.rooms.category.create')) active @endif">
                      <i class="far fa-double-circle nav-icon"></i>
                      <p>Add Category</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="nav-item ">
                <a href="{{ route('room.index') }}" class="nav-link @if(Request::url() == route('room.index')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rooms</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @if(Request::url() == route('admin.food.category.create')) menu-is-opening menu-open @endif">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Food Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.food.category.create')}}" class="nav-link @if(Request::url() == route('admin.food.category.create')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Login & Register v1
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/examples/login.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/register.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v1</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p class="text">Change Password</p>
            </a>
          </li>
          <li class="nav-item">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
              @csrf
              @method('DELETE')
          </form>
          
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>