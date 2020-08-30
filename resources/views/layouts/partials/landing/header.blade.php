<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    info@unesa.ac.id
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +6231-99423002
                </div>
            </div>
            <div class="ht-right">
                <a href="{{ auth()->user() ? route('dashboard') : route('login') }}" class="login-panel"><i class="fa fa-user"></i>{{ auth()->user() ? auth()->user()->name : 'Login' }}</a>
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="d-flex flex-row">
                <div class="">
                    <div class="logo">
                        <a href="./index.html">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/75/Unesa.png" alt="" width="100rem" height="100rem">
                        </a>
                    </div>
                </div>
                <div class="ml-2 d-flex align-items-center">
                    <h2><b>Unesa Career Center</b></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                    <li class="{{ request()->is('lowongan') ? 'active' : '' }}"><a href="{{ route('home.lowongan') }}">Vacancy</a></li>
                    <li><a href="#">Layanan</a>
                    </li>
                    <li><a href="#">Berita</a>
                    </li>
                    <li><a href="#">Pengumuman</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>