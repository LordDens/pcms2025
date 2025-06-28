<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +62 812 3456 7890</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> info@juraganrental.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Yogyakarta, Indonesia</a></li>
            </ul>
                <ul class="header-links pull-right">
                    @auth
                        <li><a href="#"><i class="fa fa-user-o"></i> {{ Auth::user()->name }}</a></li>
                        <li><a href="{{ route('profile.edit') }}"><i class="fa fa-cog"></i> Akun Saya</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; padding: 0; color: #fff;">
                                    <i class="fa fa-sign-out"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> Register</a></li>
                    @endauth
                </ul>

        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <div class="container">
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="/" class="logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Juragan Rental" style="max-height: 50px;">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <input class="input" placeholder="Cari Mobil...">
                            <button class="search-btn">Cari</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Cart -->
                        <!-- Cart -->
                            <div class="dropdown">
                                @auth
                                    @if(Auth::user()->role === 'customer')
                                        <a href="{{ route('rents.my') }}">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>Rental Saya</span>
                                        </a>
                                    @endif
                                @endauth
                            </div>

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
        </div>
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->
