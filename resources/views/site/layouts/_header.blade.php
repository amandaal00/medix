<header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="{{ asset('medilab/img/logo.png') }}" alt=""> -->
                <h1 class="sitename">{{ config('app.name') }}</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/">Beranda<br></a></li>
                    <li><a href="/about">Tentang</a></li>
                    <li><a href="/services">Layanan</a></li>
                    <li><a href="/doctors">Dokter</a></li>
                    @if (authAs('patient'))
                        <li><a href="/appointment" class="{{uriActive('appointment')}}">Halaman Pasien</a></li>
                    @elseif(authAs('doctor'))
                        <li><a href="/workspace" class="{{uriActive('workspace')}}">Halaman Dokter</a></li>                        
                    @elseif(authAs('pharmacist'))
                        <li><a href="/pharmacy" class="{{uriActive('pharmacy')}}">Halaman Apoteker</a></li>                        
                    @endif
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            @if (authAs())
                <a class="cta-btn d-none d-sm-block" id="userProfile" href="#!">{{auth()->user()->name}}</a>
            @else
                <a class="cta-btn d-none d-sm-block" href="/login">Login</a>
            @endif
        </div>
    </div>
</header>
