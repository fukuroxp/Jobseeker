<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img src="../../app-assets/images/logo/unesa.png" alt="" width="35" height="35">
                    <h2 class="brand-text mb-0">Career Center</h2>
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
            <li class=" nav-item {{ request()->is('packages') ? 'active' : '' }}"><a href="{{ route('packages.index') }}"><i class="feather icon-package"></i><span class="menu-title" data-i18n="Package">Paket Layanan</span></a>
            </li>
            <li class=" nav-item {{ request()->is('users') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">Pengguna</span></a>
            </li>
            @endif

            @if (auth()->user()->hasRole('HRD') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                <li class=" navigation-header"><span>LANGGANAN</span>
                <li class=" nav-item {{ request()->is('subscriptions') ? 'active' : '' }}"><a href="{{ route('subscriptions.index') }}"><i class="fa fa-money-bill-alt"></i><span class="menu-title" data-i18n="Package">Paket Layanan</span></a>
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
        </ul>
    </div>
</div>