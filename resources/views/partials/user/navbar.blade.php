<header class="pb-24 bg-gradient-to-r from-indigo-800 to-blue-600">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="relative flex flex-wrap items-center justify-center lg:justify-between">
            <!-- Logo -->
            <div class="absolute left-0 flex-shrink-0 lg:static">
                <a href="{{ route('user.home') }}">
                    <span class="sr-only">Logo</span>
                    <img class="h-10 w-full" src="{{ asset('images/brand2.svg') }}" alt="Brand Logo">
                </a>
            </div>

            <!-- Right section on desktop -->
            <div class="hidden lg:ml-4 lg:flex lg:items-center lg:py-5 lg:pr-0.5">
                <button type="button"
                    class="relative flex-shrink-0 p-1 text-blue-200 rounded-full hover:text-white hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: outline/bell -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    {{-- <span
                        class="absolute inline-flex items-center justify-center -top-1 -right-1 text-xs bg-red-500 text-red-100 rounded-full px-1">5</span> --}}
                </button>

                <!-- Profile dropdown -->
                <div x-data="{ isOpen: false }" class="ml-4 relative flex-shrink-0">
                    <div>
                        <button @click="isOpen = !isOpen" type="button"
                            class="bg-white rounded-full flex text-sm ring-2 ring-white ring-opacity-20 focus:outline-none focus:ring-opacity-100"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="{{ asset('images/user.png') }}" alt="User">
                        </button>
                    </div>

                    <div x-show="isOpen" x-cloak x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right z-40 absolute -right-2 mt-2 w-64 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                        <a href="#" class="flex-shrink-0 group block px-4 py-2">
                            <div class="flex items-center">
                                <div>
                                    <img class="inline-block h-9 w-9 rounded-full" src="{{ asset('images/user.png') }}"
                                        alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">
                                        Lihat Profile
                                    </p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('user.setting.profile') }}" class="block px-4 py-2 text-sm text-gray-700"
                            role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>

                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-full py-10 sm:py-5 lg:border-t lg:border-white lg:border-opacity-20">
                <div class="lg:grid lg:grid-cols-3 lg:gap-8 lg:items-center">
                    <!-- Left nav -->
                    <div class="hidden lg:block lg:col-span-2">
                        <nav class="flex space-x-4">
                            <a href="{{ route('user.home') }}"
                                class="{{ set_active('user.home', 'text-white', 'text-blue-200') }} text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"
                                aria-current="page">
                                Home
                            </a>

                            {{-- <a href="{{ route('user.coming-soon') }}"
                            class="text-blue-200 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2
                            hover:bg-opacity-10">
                            Profile
                            </a>

                            <a href="{{ route('user.coming-soon') }}"
                                class="text-blue-200 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10">
                                Rapor
                            </a>

                            <a href="{{ route('user.coming-soon') }}"
                                class="text-blue-200 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10">
                                Kehadiran
                            </a> --}}

                            <a href="{{ route('user.pembayaran') }}"
                                class="{{ set_active('user.pembayaran', 'text-white', 'text-blue-200') }} text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10">
                                Pembayaran
                            </a>
                        </nav>
                    </div>
                    <div class="px-12 lg:px-0">
                        <!-- Search -->
                        <div class="max-w-xs mx-auto hidden sm:block w-full lg:max-w-md">
                            <label for="search" class="sr-only">Search</label>
                            <div class="relative text-white focus-within:text-gray-600">
                                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <!-- Heroicon name: solid/search -->
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="search"
                                    class="block w-full text-white bg-white bg-opacity-20 py-2 pl-10 pr-3 border border-transparent rounded-md leading-5 focus:text-gray-900 placeholder-white focus:outline-none focus:bg-opacity-100 focus:border-transparent focus:placeholder-gray-500 focus:ring-0 sm:text-sm"
                                    placeholder="Search" type="search" name="search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu button -->
            <div x-data="{ id: 1 }" class="absolute right-0 flex-shrink-0 lg:hidden">
                <!-- Mobile menu button -->
                <button type="button" @click="$dispatch('mobile-menu', {id})"
                    class="bg-transparent p-2 rounded-md inline-flex items-center justify-center text-cyan-200 hover:text-white hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-white"
                    aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on mobile menu state. -->
    <div x-data="{ open: false }" x-show="open" @mobile-menu.window="if ($event.detail.id == 1) open = true"
        class="lg:hidden">
        <div x-transition:enter="duration-150 ease-out" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="duration-150 ease-in"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="z-20 fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>

        <div x-transition:enter="duration-150 ease-out" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-150 ease-in"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="z-30 absolute top-0 inset-x-0 max-w-3xl mx-auto w-full p-2 transition transform origin-top">
            <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y divide-gray-200">
                <div class="pt-3 pb-2">
                    <div class="flex items-center justify-between px-4">
                        <div>
                            <img class="h-8 w-auto" src="{{ asset('images/brand.svg') }}" alt="Workflow">
                        </div>
                        <div class="-mr-2">
                            <button type="button" @click="open= false"
                                class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500">
                                <span class="sr-only">Close menu</span>
                                <!-- Heroicon name: outline/x -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3 px-2 space-y-1">
                        <a href="{{ route('user.home') }}"
                            class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Home</a>

                        {{-- <a href="{{ route('user.coming-soon') }}"
                        class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100
                        hover:text-gray-800">Profile</a>

                        <a href="{{ route('user.coming-soon') }}"
                            class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Rapor</a>

                        <a href="{{ route('user.coming-soon') }}"
                            class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Kehadiran</a>
                        --}}

                        <a href="{{ route('user.pembayaran') }}"
                            class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Pembayaran</a>
                    </div>
                </div>
                <div class="pt-4 pb-2">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="{{ asset('images/user.png') }}" alt="">
                        </div>
                        <div class="ml-3 min-w-0 flex-1">
                            <div class="text-base font-medium text-gray-800 truncate">{{ auth()->user()->name }}</div>
                            <div class="text-sm font-medium text-gray-500 truncate">{{ auth()->user()->email }}
                            </div>
                        </div>
                        <button
                            class="ml-auto flex-shrink-0 bg-white p-1 text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            <span class="sr-only">View notifications</span>
                            <!-- Heroicon name: outline/bell -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-3 px-2 space-y-1">
                        <a href="{{ route('user.setting.profile') }}"
                            class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Settings</a>

                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"
                            class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Sign
                            out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
