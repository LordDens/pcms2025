<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="{{ url('/') }}">Beranda</a></li>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="{{ request()->routeIs('rents.index') ? 'active' : '' }}">
                            <a href="{{ route('rents.index') }}">Data Sewa</a>
                        </li>
                        <li class="{{ request()->routeIs('car.create') ? 'active' : '' }}">
                            <a href="{{ route('car.create') }}">Mobil</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.laporan.index') }}">Laporan</a>
                        </li>
                    @endif
                @endauth
                <li class="nav-item">
                     <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
                        </li>
                
                @auth
                    @if(Auth::user()->role === 'customer')
                        <li><a href="{{ route('orders.create') }}">Pesan Kendaraan</a></li>
                    @endif
                @endauth
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->
