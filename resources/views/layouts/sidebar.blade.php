<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto mt-1">
                <h1>STAMMP</h1>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ request()->is('/') || request()->is('bolg/*/details') ? 'active' : 'nav-item' }}">
                <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate">All Blogs</span>
                </a>
            </li>
            <li
                class="{{ request()->is('blogs*') || request()->is('create/blog*') || request()->is('edit/*/blog') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('blogs') }}">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate">Blog Management</span>
                </a>
            </li>
            @if (\Auth::user())
                <li class="{{ request()->is('my-blogs') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('my.blogs') }}">
                        <i data-feather="grid"></i>
                        <span class="menu-title text-truncate">My Blogs</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
