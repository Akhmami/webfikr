<div>
    <div class="bg-white rounded-xl p-4">
        <div class="flex justify-between items-center">
            <h3 class="text-xl leading-6 font-medium text-gray-900">
                Report Transaksi
            </h3>
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                <select id="tabs" name="tabs"
                    class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                    <option selected>My Account</option>

                    <option>Company</option>

                    <option>Team Members</option>

                    <option>Billing</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <nav class="relative z-0 rounded-lg shadow flex divide-x divide-gray-200" aria-label="Tabs">
                    <a href="#"
                        class="text-gray-900 rounded-l-lg group relative overflow-hidden bg-white py-3 px-6 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                        aria-current="page">
                        <span>Harian</span>
                        <span aria-hidden="true" class="bg-indigo-500 absolute inset-x-0 bottom-0 h-0.5"></span>
                    </a>

                    <a href="#"
                        class="text-gray-500 hover:text-gray-700 group relative overflow-hidden bg-white py-3 px-6 text-sm font-medium text-center hover:bg-gray-50 focus:z-10">
                        <span>Mingguan</span>
                        <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                    </a>

                    <a href="#"
                        class="text-gray-500 hover:text-gray-700 rounded-r-lg group relative overflow-hidden bg-white py-3 px-6 text-sm font-medium text-center hover:bg-gray-50 focus:z-10">
                        <span>Bulanan</span>
                        <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                    </a>
                </nav>
            </div>
        </div>

        <dl class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-xl overflow-hidden">
                <dt>
                    <div class="absolute bg-indigo-500 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="ml-16 text-sm font-medium text-gray-500 truncate">Total Nominal</p>
                </dt>
                <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">
                        8,000,000,000
                    </p>
                    <div class="absolute bottom-0 inset-x-0 bg-indigo-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> View
                                all</a>
                        </div>
                    </div>
                </dd>
            </div>
            <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-xl overflow-hidden">
                <dt>
                    <div class="absolute bg-blue-500 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                        </svg>
                    </div>
                    <p class="ml-16 text-sm font-medium text-gray-500 truncate">Total Transaksi</p>
                </dt>
                <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">
                        135
                    </p>
                    <div class="absolute bottom-0 inset-x-0 bg-blue-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500"> View
                                all</a>
                        </div>
                    </div>
                </dd>
            </div>
            <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-xl overflow-hidden">
                <dt>
                    <div class="absolute bg-red-500 rounded-md p-3">
                        <!-- Heroicon name: outline/users -->
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <p class="ml-16 text-sm font-medium text-gray-500 truncate">Belum Lunas</p>
                </dt>
                <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">
                        135
                    </p>
                    <div class="absolute bottom-0 inset-x-0 bg-red-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-red-600 hover:text-red-500"> View
                                all</a>
                        </div>
                    </div>
                </dd>
            </div>
            <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-xl overflow-hidden">
                <dt>
                    <div class="absolute bg-green-500 rounded-md p-3">
                        <!-- Heroicon name: outline/users -->
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <p class="ml-16 text-sm font-medium text-gray-500 truncate">Sudah Lunas</p>
                </dt>
                <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">
                        45
                    </p>
                    <div class="absolute bottom-0 inset-x-0 bg-green-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-green-600 hover:text-green-500"> View
                                all</a>
                        </div>
                    </div>
                </dd>
            </div>
        </dl>
    </div>
</div>
