<x-dash-layout>
    <x-slot name="breadtitle">
        Manajemen User
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex space-x-4">
            <div class="w-4/6">
                <div class="bg-white rounded divide-y border">
                    <div class="divide-y">
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
