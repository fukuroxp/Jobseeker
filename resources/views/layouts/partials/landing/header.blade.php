<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    admin@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +65 11.188.888
                </div>
            </div>
            <div class="ht-right">
                <a href="#" class="login-panel"><i class="fa fa-user"></i>Login</a>
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
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo float-right">
                        <a href="./index.html">
                            <img src="{{ asset('fashi/img/dwp.png') }}" alt="" width="100rem" height="100rem">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 d-flex align-items-center float-right">
                    <h2><b>Dharma Wanita Persatuan Dinas Pendidikan Provinsi Jawa Timur</b></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="active"><a href="/">Beranda</a></li>
                    <li><a href="#">Profil</a>
                        <ul class="dropdown">
                            <li><a href="#">Sejarah DWP</a></li>
                            <li><a href="#">Anggota</a></li>
                            <li><a href="#">Struktur</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Layanan</a>
                        <ul class="dropdown">
                            <li><a href="#">E-Proker</a></li>
                            <li><a href="#">Gedung DWP</a></li>
                            <li><a href="#">Toko DWP</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Berita</a>
                        <ul class="dropdown">
                            <li><a href="#">Berita Internal</a></li>
                            <li><a href="#">Berita Eksternal</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Publikasi</a>
                        <ul class="dropdown">
                            <li><a href="#">Pengumuman</a></li>
                            <li><a href="#">Dokumen Sekretariat</a></li>
                            <li><a href="#">Gallery Foto</a></li>
                            <li><a href="#">Gallery Video</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('pengumuman.lomba') }}">Pengumuman Lomba</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>