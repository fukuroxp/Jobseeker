<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('app-assets/images/logo/unesa.png') }}" alt="" width="35" height="35">
                    <h2 class="brand-text mb-0">Virtual Career Fair</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ request()->is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
            <li class=" navigation-header"><span>DATA MASTER</span>
            </li>
            <li class=" nav-item {{ request()->is('users') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">Pengguna</span></a>
            </li>
            <li class=" nav-item {{ request()->is('perusahaan') ? 'active' : '' }}"><a href="{{ route('perusahaan.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">Permintaan Akses <span class="badge badge-info badge-sm">{{\DB::table('users')
                ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                ->where(['role_id' => 3, 'status' => NULL])
                ->count()}}</span></span></a>
            </li>
            <li class=" nav-item {{ request()->is('mitra') ? 'active' : '' }}"><a href="{{ route('mitra.list') }}"><i class="fa fa-building"></i><span class="menu-title" data-i18n="User">Perusahaan Mitra</span></a>
            </li>
           <li class=" nav-item {{ request()->is('kategori') ? 'active' : '' }}"><a href="{{ route('category.index') }}"><i class="fa fa-list-alt"></i><span class="menu-title" data-i18n="Package">Kategori Lowongan</span></a>
            </li>
            
            <li class=" nav-item {{ request()->is('sliders') ? 'active' : '' }}"><a href="{{ route('sliders.index') }}"><i class="feather icon-image"></i><span class="menu-title" data-i18n="User">Slider</span></a>
            </li>
            <li class=" nav-item {{ request()->is('sponsor') ? 'active' : '' }}"><a href="{{ route('sponsor.index') }}"><i class="feather icon-at-sign"></i><span class="menu-title" data-i18n="User">Sponsor</span></a>
            </li>
            <li class=" nav-item {{ request()->is('video') ? 'active' : '' }}"><a href="{{ route('video.index') }}"><i class="feather icon-video"></i><span class="menu-title" data-i18n="User">Video</span></a>
            </li>
            @endif

            <li class=" navigation-header"><span>LOKER</span>
            <li class=" nav-item {{ request()->is('jobs') ? 'active' : '' }}"><a href="{{ route('jobs.index') }}"><i class="fa fa-address-card"></i><span class="menu-title" data-i18n="Package">Lowongan</span></a>
            </li>
            <li class=" nav-item {{ request()->is('applicants') ? 'active' : '' }}"><a href="{{ route('applicants.index') }}"><i class="fa fa-user-tie"></i><span class="menu-title" data-i18n="Package">Lamaran</span></a>
            </li>

            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                <li class=" navigation-header"><span>BLOG</span>
                <li class=" nav-item {{ request()->is('articles') ? 'active' : '' }}"><a href="{{ route('articles.index') }}"><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Article">Artikel</span></a>
                </li>
            @endif

            {{-- @if (auth()->user()->hasRole('HRD') || auth()->user()->hasRole('Jobseeker')) --}}
                <li class=" navigation-header"><span>Panduan</span>
                <li class=" nav-item {{ request()->is('guides') ? 'active' : '' }}"><a href="{{ route('guides.index') }}"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="Documentation">Buku Panduan</span></a>
                </li>
            {{-- @endif --}}
        </ul>
    </div>
</div>
