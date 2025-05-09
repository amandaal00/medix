<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline" action="/admin/transaction" method="get">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="submit" data-widget="navbar-search">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="/admin/user/{{auth()->user()->id}}?role={{auth()->user()->role}}" class="dropdown-item">
                <i class="fas fa-user mr-2"></i>
                Profile
            </a>
            @if (authAs('maintainer'))
                <div class="dropdown-divider"></div>
                <a href="/admin/setting" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i>
                    Setting
                </a>                
            @endif
            <div class="dropdown-divider"></div>
            <a href="/logout" class="dropdown-item">
                <i class="fas fa-power-off mr-2"></i>
                Logout
            </a>
        </li>
    </ul>
</nav>