<x-dash-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row space-x-4 mb-6">
            <div class="md:w-4/6 flex flex-col px-4 md:px-0">
                <!-- Stat here -->
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Dashboard
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>
                    <div class="mb-6 bg-white rounded shadow py-4">
                        <div class="flex items-center justify-around">
                            <div class="flex items-center space-x-4">
                                <div class="rounded-full bg-blue-500 p-4">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-lg text-gray-700">1000</p>
                                    <p class="text-sm text-gray-500">Santri</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="rounded-full bg-green-500 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-lg text-gray-700">250</p>
                                    <p class="text-sm text-gray-500">Guru</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="rounded-full bg-red-500 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                                        <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-lg text-gray-700">145</p>
                                    <p class="text-sm text-gray-500">Artikel</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="rounded-full bg-yellow-500 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-lg text-gray-700">4500</p>
                                    <p class="text-sm text-gray-500">Tagihan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik -->
                <div class="flex-1">
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Statistik Pengunjung
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>
                    <div class="bg-white rounded shadow flex items-center h-auto">
                        <div class="overflow-hidden w-full md:flex" style="max-width:900px"
                            x-data="{stockTicker:stockTicker()}" x-init="stockTicker.renderChart()">
                            <div class="flex flex-col w-full md:w-3/4 pl-6 py-6 bg-white text-white">
                                <div class="flex justify-between pr-4 pl-1 mb-4">
                                    <div class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div class="text-gray-700 text-xs font-semibold">Juni 2021</div>
                                    </div>
                                    <div class="flex space-x-4">
                                        <div class="text-gray-500 uppercase text-sm font-semibold">Tahun</div>
                                        <div class="text-gray-500 uppercase text-sm font-semibold">Bulan</div>
                                        <div class="text-gray-700 uppercase text-sm font-semibold">Pekan</div>
                                    </div>
                                </div>
                                <canvas id="chart" class="w-full"></canvas>
                            </div>
                            <div class="w-full md:w-1/4 py-6 pr-6 pl-3 text-gray-600">
                                <div
                                    class="w-full h-full bg-blue-500 rounded flex flex-col items-center justify-center space-y-2">
                                    <h3 class="text-lg font-semibold leading-tight text-gray-100">Hari ini</h3>
                                    <div class="text-gray-100 text-4xl font-bold">123</div>
                                    <div class="text-gray-100 text-sm">Pengunjung</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:w-2/6 mt-6 pr-4 md:pr-0 md:mt-0 flex flex-col">
                <div class="flex-1">
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Reports
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>
                    <div class="flex flex-col space-y-4">
                        <div class="bg-white rounded shadow">
                            <div class="flex items-center space-x-4 p-4">
                                <div class="rounded-full bg-green-100 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-700 font-semibold">Lorem ipsum dolor sit amet
                                    consectetur
                                    adipisicing elit.</p>
                            </div>
                            <div class="flex justify-between items-center px-4 pt-2 pb-4">
                                <p class="text-gray-500 text-xs">1 menit yang lalu</p>
                                <div class="flex items-center text-blue-500">
                                    <a href="#" class="uppercase font-semibold">Detail</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded shadow">
                            <div class="flex items-center space-x-4 p-4">
                                <div class="rounded-full bg-blue-100 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                        <path fill-rule="evenodd"
                                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-700 font-semibold">Lorem ipsum dolor sit amet
                                    consectetur
                                    adipisicing elit.</p>
                            </div>
                            <div class="flex justify-between items-center px-4 pt-2 pb-4">
                                <p class="text-gray-500 text-xs">1 menit yang lalu</p>
                                <div class="flex items-center text-blue-500">
                                    <a href="#" class="uppercase font-semibold">Detail</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded shadow">
                            <div class="flex items-center space-x-4 p-4">
                                <div class="rounded-full bg-red-100 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-700 font-semibold">Lorem ipsum dolor sit amet
                                    consectetur
                                    adipisicing elit.</p>
                            </div>
                            <div class="flex justify-between items-center px-4 pt-2 pb-4">
                                <p class="text-gray-500 text-xs">1 menit yang lalu</p>
                                <div class="flex items-center text-blue-500">
                                    <a href="#" class="uppercase font-semibold">Detail</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 hidden lg:block">
                            <button class="bg-blue-500 rounded shadow py-4 text-white font-semibold uppercase w-full">
                                lainnya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="w-4/6">
                <!-- Tabel -->
                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Aktifitas User
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 rounded">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Title
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Email
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Role
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Odd row -->
                                            <tr class="bg-white">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    Regional Paradigm Technician
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    Admin
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                            </tr>

                                            <!-- Even row -->
                                            <tr class="bg-gray-50">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    Cody Fisher
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    Product Directives Officer
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    cody.fisher@example.com
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    Owner
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                            </tr>

                                            <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-2/6">
                <div class="mb-6">
                    <div class="mb-2 flex items-center justify-between">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Kelas Aktif
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
                            Balance
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

    <script>
        Number.prototype.m_formatter = function() {
            return this > 999999 ? (this / 1000000).toFixed(1) + 'M' : this
        };
    let stockTicker = function(){
        return {
            chartData: {
                labels: ['10:00','','','','12:00','','','','2:00','','','','4:00'],
                data: [2.23,2.215,2.22,2.25,2.245,2.27,2.28,2.29,2.3,2.29,2.325,2.325,2.32],
            },
            renderChart: function(){
                let c = false;

                Chart.helpers.each(Chart.instances, function(instance) {
                    if (instance.chart.canvas.id == 'chart') {
                        c = instance;
                    }
                });

                if(c) {
                    c.destroy();
                }

                let ctx = document.getElementById('chart').getContext('2d');

                let chart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: this.chartData.labels,
                        datasets: [
                            {
                                label: '',
                                backgroundColor: "rgba(37, 99, 235, 0.2)",
                                borderColor: "rgba(37, 99, 235, 1)",
                                pointBackgroundColor: "rgba(37, 99, 235, 1)",
                                data: this.chartData.data,
                            },
                        ],
                    },
                    layout: {
                        padding: {
                            right: 10
                        }
                    },
                    options: {
                        legend: {
                            display: false,
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: "rgba(55, 65, 81, 1)",
                                },
                                gridLines: {
                                    color: "rgba(55, 65, 81, .2)",
                                    borderDash: [5, 5],
                                    zeroLineColor: "rgba(55, 65, 81, .2)",
                                    zeroLineBorderDash: [5, 5]
                                },
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: "rgba(55, 65, 81, 1)",
                                },
                                gridLines: {
                                    display: false,
                                },
                            }]
                        }
                    }
                });
            }
        }
    }
    </script>
</x-dash-layout>
