<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">

    {{-- 1. Container --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- 1.1 Logo & Menu Kiri --}}
            <div class="flex">
                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                {{-- Menu Navigasi Kiri --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Admin Only: Data Sewa --}}
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.rents.index')" :active="request()->routeIs('admin.rents.index')">
                                {{ __('Data Sewa') }}
                            </x-nav-link>
                        @endif

                        @if(Auth::check() && Auth::user()->role === 'user')
                            <x-nav-link :href="route('orders.user')" :active="request()->routeIs('orders.user')">
                                {{ __('Rental Saya') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- 1.2 Menu Kanan (Akun/Login) --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                @auth
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        <i class="fa fa-user"></i> {{ Auth::user()->name }}
                    </span>
                    <a href="{{ route('profile.edit') }}" class="text-sm text-red-500 hover:underline">
                        <i class="fa fa-gear"></i> Akun Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-500 hover:underline" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                        </button>
                    </form>
                 @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        {{ __('Login') }}
                    </a>
                    <span class="text-sm text-gray-400">|</span>
                    <a href="{{ route('register') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        {{ __('Register') }}
                    </a>
                @endauth
            </div>

            {{-- 1.3 Hamburger (Mobile Menu Toggle) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- 2. Responsive Navigation (Mobile) --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        {{-- 2.1 Menu --}}
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @auth
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.rents.index')" :active="request()->routeIs('admin.rents.index')">
                        {{ __('Data Sewa') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        {{-- 2.2 Akun (Responsive) --}}
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Akun Saya') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">Guest</div>
                    <div class="font-medium text-sm text-gray-500">Not Logged In</div>
                </div>
            @endauth
        </div>
    </div>
</nav>
