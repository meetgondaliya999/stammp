    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <ul class="nav navbar-nav align-items-center ms-auto">

                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                            data-feather="moon"></i></a></li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                        id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">

                        @if (!empty(auth()->user()->name))
                            <div class="user-nav d-sm-flex d-none"><span
                                    class="user-name fw-bolder">{{ auth()->user()->name }}</span><span
                                    class="user-status"></span></div>
                            <span class="avatar"><img class="round"
                                    src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar"
                                    height="40" width="40"><span class="avatar-status-online"></span></span>
                        @else
                            <div class="user-nav d-sm-flex d-none"><a href="{{ route('login') }}"><span
                                        class="user-name fw-bolder">Login</span></a><span class="user-status"></span>
                            </div>
                        @endif


                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item w-100" type="submit"><i class="me-50"
                                    data-feather="power"></i> Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->
