<nav class="bg-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-10 w-full" src="{{ asset('images/brand2.svg') }}" alt="Brand Logo">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4" x-data>
                        <!-- Current: "bg-indigo-700 text-white", Default: "text-white hover:bg-indigo-500 hover:bg-opacity-75" -->
                        <a href="#"
                            class="bg-blue-700 text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>

                        <a @click.prevent="$dispatch('open-dropdown',{id: 1, menu: 'website'})" href="#"
                            class="inline-flex items-center group text-white hover:bg-blue-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium">
                            <span>Website</span>
                            <svg class="ml-1 -mr-1 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a @click.prevent="$dispatch('open-dropdown',{id: 1, menu: 'santri'})" href="#"
                            class="inline-flex items-center group text-white hover:bg-blue-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium">
                            <span>Santri</span>
                            <svg class="ml-1 -mr-1 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a @click.prevent="$dispatch('open-dropdown',{id: 1, menu: 'keuangan'})" href="#"
                            class="inline-flex items-center group text-white hover:bg-blue-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium">
                            <span>Keuangan</span>
                            <svg class="ml-1 -mr-1 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a href="#"
                            class="text-white hover:bg-blue-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium">CBT</a>

                        <a href="#"
                            class="text-white hover:bg-blue-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium">User</a>

                        <a @click.prevent="$dispatch('open-dropdown',{id: 1, menu: 'lainnya'})" href="#"
                            class="inline-flex items-center group text-white hover:bg-blue-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium">
                            <span>Lainnya</span>
                            <svg class="ml-1 -mr-1 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <div x-data="{ isOpen: false }" class="relative">
                        <button @click="isOpen = !isOpen"
                            class="bg-blue-600 p-1 rounded-full text-blue-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-600 focus:ring-white">
                            <span class="sr-only">View notifications</span>
                            <!-- Heroicon name: outline/bell -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>

                        <div x-show="isOpen" @click.away="isOpen = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                <a href="#"
                                    class="-m-3 p-3 block rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                    <p class="text-base font-medium text-gray-900">
                                        Blog
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Learn about tips, product updates and company culture.
                                    </p>
                                </a>

                                <a href="#"
                                    class="-m-3 p-3 block rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                    <p class="text-base font-medium text-gray-900">
                                        Help Center
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Get all of your questions answered in our forums of contact support.
                                    </p>
                                </a>

                                <a href="#"
                                    class="-m-3 p-3 block rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                    <p class="text-base font-medium text-gray-900">
                                        Guides
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Learn how to maximize our platform to get the most out of it.
                                    </p>
                                </a>

                                <a href="#"
                                    class="-m-3 p-3 block rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                    <p class="text-base font-medium text-gray-900">
                                        Events
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Check out webinars with experts and learn about our annual conference.
                                    </p>
                                </a>

                                <a href="#"
                                    class="-m-3 p-3 block rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                    <p class="text-base font-medium text-gray-900">
                                        Security
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Understand how we take your privacy seriously.
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile dropdown -->
                    <div x-data="{ isOpen: false }" class="ml-3 relative">
                        <button type="button" @click="isOpen = !isOpen"
                            class="max-w-xs bg-blue-600 rounded-full flex items-center text-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-600 focus:ring-white"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="">
                        </button>

                        <div x-show="isOpen" @click.away="isOpen = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-64 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="#" class="flex-shrink-0 group block px-4 py-2">
                                <div class="flex items-center">
                                    <div>
                                        <img class="inline-block h-9 w-9 rounded-full"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
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

                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                id="user-menu-item-1">Settings</a>

                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                id="user-menu-item-2">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden" x-data="{btn: 1}">
                <!-- Mobile menu button -->
                <button type="button" @click="$dispatch('open-dropdown',{btn})"
                    class="bg-blue-600 inline-flex items-center justify-center p-2 rounded-md text-blue-200 hover:text-white hover:bg-blue-500 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-600 focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!--
                  Heroicon name: outline/menu

                  Menu open: "hidden", Menu closed: "block"
                -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!--
                  Heroicon name: outline/x

                  Menu open: "block", Menu closed: "hidden"
                -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-data="{ open: false }" x-show="open" @open-dropdown.window="if ($event.detail.btn == 1) open = true"
        @click.away="open = false" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" class="md:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <!-- Current: "bg-indigo-700 text-white", Default: "text-white hover:bg-indigo-500 hover:bg-opacity-75" -->
            <a href="#" class="bg-blue-700 text-white block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>

            <a href="#"
                class="text-white hover:bg-blue-500 hover:bg-opacity-75 block px-3 py-2 rounded-md text-base font-medium">Team</a>

            <a href="#"
                class="text-white hover:bg-blue-500 hover:bg-opacity-75 block px-3 py-2 rounded-md text-base font-medium">Projects</a>

            <a href="#"
                class="text-white hover:bg-blue-500 hover:bg-opacity-75 block px-3 py-2 rounded-md text-base font-medium">Calendar</a>

            <a href="#"
                class="text-white hover:bg-blue-500 hover:bg-opacity-75 block px-3 py-2 rounded-md text-base font-medium">Reports</a>
        </div>
        <div class="pt-4 pb-3 border-t border-blue-700">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full"
                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-white">Tom Cook</div>
                    <div class="text-sm font-medium text-blue-300">tom@example.com</div>
                </div>
                <button
                    class="ml-auto bg-blue-600 flex-shrink-0 p-1 border-2 border-transparent rounded-full text-blue-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-600 focus:ring-white">
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
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-500 hover:bg-opacity-75">Your
                    Profile</a>

                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-500 hover:bg-opacity-75">Settings</a>

                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-500 hover:bg-opacity-75">logout</a>
            </div>
        </div>
    </div>
</nav>

<header x-data="{ open: false, website: false, santri: false, keuangan: false }" x-show="open"
    @open-dropdown.window="if ($event.detail.id == 1) open = true"
    @click.away="open = website = santri = keuangan = false" x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
    class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <ul class="flex items-center justify-start" x-show="website"
            @open-dropdown.window="if ($event.detail.menu == 'website') website = true">
            <li class="flow-root">
                <a href="#"
                    class="p-3 flex items-center space-x-1 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50 transition ease-in-out duration-150">
                    <!-- Heroicon name: outline/information-circle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                    <span class="ml-4">Semua Posting</span>
                </a>
            </li>

            <li class="flow-root">
                <a href="#"
                    class="p-3 flex items-center space-x-1 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50 transition ease-in-out duration-150">
                    <!-- Heroicon name: outline/office-building -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="ml-4">Posting Baru</span>
                </a>
            </li>
        </ul>

        <ul class="flex items-center justify-start" x-show="santri"
            @open-dropdown.window="if ($event.detail.menu == 'santri') santri = true">
            <li class="flow-root">
                <a href="#"
                    class="p-3 flex items-center space-x-1 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50 transition ease-in-out duration-150">
                    <!-- Heroicon name: outline/information-circle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="ml-4">PSB</span>
                </a>
            </li>

            <li class="flow-root">
                <a href="#"
                    class="p-3 flex items-center space-x-1 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50 transition ease-in-out duration-150">
                    <!-- Heroicon name: outline/office-building -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="ml-4">Santri</span>
                </a>
            </li>
        </ul>

        <ul class="flex items-center justify-start" x-show="keuangan"
            @open-dropdown.window="if ($event.detail.menu == 'keuangan') keuangan = true">
            <li class="flow-root">
                <a href="{{ route('dash.billing.index') }}"
                    class="p-3 flex items-center space-x-1 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50 transition ease-in-out duration-150">
                    <!-- Heroicon name: outline/information-circle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                    <span class="ml-4">Billing</span>
                </a>
            </li>

            <li class="flow-root">
                <a href="#"
                    class="p-3 flex items-center space-x-1 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50 transition ease-in-out duration-150">
                    <!-- Heroicon name: outline/office-building -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="ml-4">SPP</span>
                </a>
            </li>

            <li class="flow-root">
                <a href="#"
                    class="p-3 flex items-center space-x-1 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50 transition ease-in-out duration-150">
                    <!-- Heroicon name: outline/office-building -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <span class="ml-4">Histori Pembayaran</span>
                </a>
            </li>
        </ul>
    </div>
</header>
