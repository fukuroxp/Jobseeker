<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0" style="font-size: 14px">StudyMultimedia</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="btn-collapse nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <div class="company" style="padding:1em 15px;background:#f9f9f9;">
            <div class="col-md-12">
                <div class="d-flex justify-content-center mt-1 mb-0">
                    <div>
                        <img class="d-flex justify-content-center" src="{{ asset('uploads/images/logo.png') }}" alt="">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-1 mb-0">
                    <strong>SMK NEGERI 1 JOMBANG</strong>
                </div>
            </div>
        </div>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ request()->is('home') ? ' active' : '' }}"><a href="{{ route('home') }}"><i class="fa fa-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            @if (auth()->user()->hasRole('admin'))
            <li class=" nav-item"><a href="#"><i class="fa fa-database"></i><span class="menu-title" data-i18n="Data Master">Data Master</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->is('kelas') ? ' active is-shown' : '' }}">
                        <a href="{{ route('kelas.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Data Kelas">Data Kelas</span></a>
                    </li>
                    <li class="{{ request()->type == 'mentor' ? ' active is-shown' : '' }}">
                        <a href="{{ route('users.index', ['type' => 'mentor']) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Data Guru">Data Guru</span></a>
                    </li>
                    <li class="{{ request()->type == 'student' ? ' active is-shown' : '' }}">
                        <a href="{{ route('users.index', ['type' => 'student']) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Data Siswa">Data Siswa</span></a>
                    </li>
                </ul>
            </li>
            @endif
            <li class=" nav-item {{ request()->is('materi') ? ' active' : '' }}"><a href="{{ route('materi.index') }}"><i class="fa fa-book"></i><span class="menu-title" data-i18n="Materi">Materi</span></a>
            </li>
            <li class=" nav-item {{ request()->is('video') ? ' active' : '' }}"><a href="{{ route('video.index') }}"><i class="fa fa-play-circle"></i><span class="menu-title" data-i18n="Video">Video</span></a>
            </li>
            <li class=" nav-item {{ request()->is('task') ? ' active' : '' }}"><a href="{{ route('task.index') }}"><i class="fa fa-clipboard-check"></i><span class="menu-title" data-i18n="Task">Tugas</span></a>
            </li>
            @if (!auth()->user()->hasRole('student'))
            <li class=" nav-item {{ request()->is('soal/*') ? ' active' : '' }}"><a href="{{ route('soal.index') }}"><i class="fa fa-scroll"></i><span class="menu-title" data-i18n="Soal">Soal</span></a>
            </li>
            @else
            <li class=" nav-item"><a href="#"><i class="fa fa-scroll"></i><span class="menu-title" data-i18n="Exam">Ujian</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->type == 'UTS' ? ' active is-shown' : '' }}">
                        <a href="{{ route('soal.index', ['type' => 'UTS']) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Data Guru">UTS</span></a>
                    </li>
                    <li class="{{ request()->type == 'UAS' ? ' active is-shown' : '' }}">
                        <a href="{{ route('soal.index', ['type' => 'UAS']) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Data Siswa">UAS</span></a>
                    </li>
                </ul>
            </li>
            @endif
            <li class=" nav-item"><a href="#"><i class="fa fa-clipboard"></i><span class="menu-title" data-i18n="Laporan">Laporan</span></a>
                <ul class="menu-content">
                    @if (!auth()->user()->hasRole('student'))
                        <li class="{{ request()->is('activity') ? ' active is-shown' : '' }}">
                            <a href="{{ route('report.activity') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Activity">Aktifitas Siswa</span></a>
                        </li>
                    @endif
                    <li class="{{ request()->is('nilai') ? ' active is-shown' : '' }}">
                        <a href="{{ route('report.nilai') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Nilai">Nilai</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>