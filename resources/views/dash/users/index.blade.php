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
                        <div class="flex flex-col space-y-4 p-4 text-gray-500 font-light mb-4">
                            <div class="p-4 shadow rounded flex items-center justify-between">
                                <span>IPA 1</span>
                                <div class="flex items-center space-x-4">
                                    <div class="flex flex-1 items-center space-x-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                        </svg>
                                        <span>32</span>
                                    </div>
                                    <div class="rounded-full bg-blue-500 p-1">
                                        <svg class="h-4 w-4 text-gray-100" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 shadow rounded flex items-center justify-between">
                                <span>IPA 2</span>
                                <div class="flex items-center space-x-4">
                                    <div class="flex flex-1 items-center space-x-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                        </svg>
                                        <span>32</span>
                                    </div>
                                    <div class="rounded-full bg-blue-500 p-1">
                                        <svg class="h-4 w-4 text-gray-100" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 shadow rounded flex items-center justify-between">
                                <span>IPS 1</span>
                                <div class="flex items-center space-x-4">
                                    <div class="flex flex-1 items-center space-x-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                        </svg>
                                        <span>32</span>
                                    </div>
                                    <div class="rounded-full bg-blue-500 p-1">
                                        <svg class="h-4 w-4 text-gray-100" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
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
                        <div class="flex items-center space-x-4 p-4">
                            <div class="rounded-full bg-green-100 p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-2">
                                    Income bulan
                                    <select name="" class="border-0 w-32 p-0 text-sm font-semibold">
                                        @for ($i = 1; $i <= 12; $i++) <option value="{{ $i .'-'. date('Y') }}">
                                            {{ tanggal($i, 'm') .' '. date('Y') }}</option>
                                            @endfor
                                    </select>
                                </p>
                                <p class="text-2xl text-gray-700 font-semibold">Rp 1.000.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-dash-layout>
