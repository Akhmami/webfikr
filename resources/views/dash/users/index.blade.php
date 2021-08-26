<x-dash-layout>
    <x-slot name="breadtitle">
        Manajemen User
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex space-x-4">
            <div class="w-4/6">

                <div x-data="{ tab: window.location.hash ? window.location.hash : '#permission' }"
                    class="bg-white rounded divide-y border">
                    <div>
                        <div class="sm:hidden">
                            <label for="tabs" class="sr-only">Select a tab</label>
                            <select id="tabs" name="tabs"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option selected>Hak Akses User</option>

                                <option>Halaman User</option>

                                <option>Aktifitas User</option>
                            </select>
                        </div>
                        <div class="hidden sm:block">
                            <div>
                                <nav class="-mb-px flex" aria-label="Tabs">
                                    <a href="#" x-on:click.prevent="tab='#permission'"
                                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#permission' }"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-indigo-500 border-b-2 whitespace-nowrap flex py-4 px-6 font-medium text-sm">
                                        <span>Hak Akses User</span>
                                    </a>

                                    <a href="#" x-on:click.prevent="tab='#halaman-user'"
                                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#halaman-user' }"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-indigo-500 border-b-2 whitespace-nowrap flex py-4 px-6 font-medium text-sm">
                                        <span>Halaman User</span>
                                    </a>

                                    <a href="#" x-on:click.prevent="tab='#aktifitas-user'"
                                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#aktifitas-user' }"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-indigo-500 border-b-2 whitespace-nowrap flex py-4 px-6 font-medium text-sm">
                                        <span>Aktifitas User</span>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Permission -->
                    <div class="divide-y" x-show="tab == '#permission'" x-cloak>
                        <div class="flex items-center justify-between px-2 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Hak Akses User
                            </div>
                            <button type="button" onclick="Livewire.emit('openModal', 'dash.users.user-create')"
                                class="inline-flex items-center pl-3 pr-4 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>NEW</span>
                            </button>
                        </div>
                        <div class="rounded-b flex flex-col px-2 py-4">
                            <livewire:dash.users.users-table />
                        </div>
                    </div>
                    <!-- Tab halaman user -->
                    <div x-show="tab == '#halaman-user'" x-cloak>
                        <div x-data="{ subtab: '#berita-terbaru' }" class="divide-y">
                            <div class="flex items-center justify-between px-2 py-4">
                                <div class="text-md font-medium uppercase text-gray-700">
                                    Halaman User
                                </div>

                                <div>
                                    <div class="sm:hidden">
                                        <label for="tabs" class="sr-only">Select a tab</label>
                                        <select id="tabs" name="tabs"
                                            class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                            <option>Posting</option>

                                            <option selected>Berita Terbaru</option>
                                        </select>
                                    </div>
                                    <div class="hidden sm:block">
                                        <nav class="flex space-x-4" aria-label="Tabs">
                                            <a href="#" x-on:click.prevent="subtab='#posting'"
                                                :class="{ 'bg-indigo-100 text-indigo-700' : subtab === '#posting' }"
                                                class="text-gray-500 hover:text-gray-700 px-3 py-2 font-medium text-sm rounded-md">
                                                Posting
                                            </a>

                                            <a href="#" x-on:click.prevent="subtab='#berita-terbaru'"
                                                :class="{ 'bg-indigo-100 text-indigo-700' : subtab === '#berita-terbaru' }"
                                                class="bg-indigo-100 text-indigo-700 px-3 py-2 font-medium text-sm rounded-md"
                                                aria-current="page">
                                                Berita Terbaru
                                            </a>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-b flex flex-col px-2 py-4">
                                <div x-show="subtab == '#posting'" x-cloak>
                                    <livewire:dash.users.posting />
                                </div>
                                <div x-show="subtab == '#berita-terbaru'" x-cloak>
                                    <livewire:dash.users.berita-terbaru />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Aktifitas user -->
                    <div class="divide-y" x-show="tab == '#aktifitas-user'" x-cloak>
                        <div class="flex items-center justify-between px-2 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Aktifitas User
                            </div>
                            {{-- <button type="button" onclick="Livewire.emit('openModal', 'dash.users.user-create')"
                                class="inline-flex items-center pl-3 pr-4 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>NEW</span>
                            </button> --}}
                        </div>
                        <div class="rounded-b flex flex-col px-2 py-4">
                            <livewire:dash.users.user-activities-table />
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-2/6">
                <div class="mb-6">
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Role
                        </div>
                        <button type="button" onclick="Livewire.emit('openModal', 'dash.users.role-create')"
                            class="inline-flex items-center pl-2 pr-3 py-1 border border-transparent text-xs font-medium rounded text-blue-700 hover:bg-blue-600 hover:text-white hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>NEW</span>
                        </button>
                    </div>
                    <div class="bg-white rounded shadow">
                        <div class="p-4 font-light">
                            <livewire:dash.users.roles />
                        </div>
                    </div>
                </div>

                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Permission
                        </div>
                        @if (Auth::user()->hasRole('super-admin'))
                        <button type="button" onclick="Livewire.emit('openModal', 'dash.users.permission-create')"
                            class="inline-flex items-center pl-2 pr-3 py-1 border border-transparent text-xs font-medium rounded text-blue-700 hover:bg-blue-600 hover:text-white hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>NEW</span>
                        </button>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        @endif
                    </div>
                    <div class="bg-white rounded shadow">
                        <div class="p-4 font-light">
                            <livewire:dash.users.permissions />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-dash-layout>
