<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('rm/img/user.jpg')}}" class="img-circle elevation-2" style="height: 34px; width: 34px; object-fit: cover" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{auth()->user()->name}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Cari Menu" aria-label="Search">
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
        <li class="nav-item">
          <a href="/admin" class="nav-link {{uriActive('admin')}}">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/users" class="nav-link {{uriActive('admin/users')}}">
            <i class="nav-icon fas fa-users"></i>
            <p>Users</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/poly" class="nav-link {{uriActive('admin/poly')}}">
            <i class="nav-icon fas fa-medkit"></i>
            <p>Poly</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/medicine" class="nav-link {{uriActive('admin/medicine')}}">
            <i class="nav-icon fas fa-tint"></i>
            <p>Medicine</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/schedule" class="nav-link {{uriActive('admin/schedule')}}">
            <i class="nav-icon fas fa-calendar"></i>
            <p>Schedule</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>