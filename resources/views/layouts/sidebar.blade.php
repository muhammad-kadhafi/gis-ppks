<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="/" class="logo text-white">
                Lacak PPKS
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="/" class="collapsed">
                        <i class="fas fa-desktop"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('sebaran') ? 'active' : '' }}">
                    <a href="/sebaran" class="collapsed">
                        <i class="fas fa-map"></i>
                        <p>Lacak PPKS</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('datappks') ? 'active' : '' }}">
                    <a href="/datappks" class="collapsed">
                        <i class="bi bi-people"></i>
                        <p>Data PPKS</p>
                    </a>
                </li>
                @if (auth()->user()->role == 1)
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Data Master</h4>
                    </li>
                    <li class="nav-item {{ Request::is('terminasi') ? 'active' : '' }}">
                        <a href="/terminasi" class="collapsed">
                            <i class="bi bi-pencil-square"></i>
                            <p>Terminasi</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('kriteria') ? 'active' : '' }}">
                        <a href="/kriteria" class="collapsed">
                            <i class="fas fa-list"></i>
                            <p>Kriteria</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
                        <a href="/users" class="collapsed">
                            <i class="bi bi-person"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
