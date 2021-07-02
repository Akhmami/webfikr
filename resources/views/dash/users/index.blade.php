<x-dash-layout>
    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex space-x-4">
            <div class="w-4/6">
                <!-- Tabel -->
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Manajemen User
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>
                    <div class="flex flex-col bg-white rounded p-2">
                        <livewire:dash.users.users-table />
                    </div>
                </div>
            </div>

            <div class="w-2/6">
                <div class="mb-6">
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Role
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
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
