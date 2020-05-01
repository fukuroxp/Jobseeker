<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-semi-dark/index.html">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">AOS</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ request()->is('home') ? ' active' : '' }}"><a href="{{ route('home') }}"><i class="fa fa-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-database"></i><span class="menu-title" data-i18n="Data Master">Data Master</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->is('products') ? ' active is-shown' : '' }}">
                        <a href="{{ route('products.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Product">Produk</span></a>
                    </li>
                    <li class="{{ request()->is('users') ? ' active is-shown' : '' }}">
                        <a href="{{ route('users.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Employee">Karyawan</span></a>
                    </li>
                    <li class="{{ request()->is('tables') ? ' active is-shown' : '' }}">
                        <a href="{{ route('tables.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Table">Meja</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('sells') ? ' active' : '' }}"><a href="{{ route('sells.index') }}"><i class="fa fa-cash-register"></i><span class="menu-title" data-i18n="Sells">Penjualan</span></a>
            </li>
        </ul>
    </div>
</div>