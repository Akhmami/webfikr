<div class="flex-1">
    <div class="text-md font-medium uppercase text-gray-700 mb-2">
        Laporan
    </div>
    <div class="flex flex-col space-y-8 bg-white rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div class="flex flex-col items-center space-y-1">
                <div class="rounded-xl bg-indigo-500 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="text-sm text-gray-500 font-semibold">Tagihan</div>
            </div>
            <div class="flex flex-col items-center space-y-1">
                <div class="rounded-xl bg-green-500 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="text-sm text-gray-500 font-semibold">Pembayaran</div>
            </div>
            <div class="flex flex-col items-center space-y-1">
                <div class="rounded-xl bg-purple-500 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path fillRule="evenodd"
                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                            clipRule="evenodd" />
                    </svg>
                </div>
                <div class="text-sm text-gray-500 font-semibold">VA</div>
            </div>
            <div class="flex flex-col items-center space-y-1">
                <div class="rounded-xl bg-orange-500 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm2.5 3a1.5 1.5 0 100 3 1.5 1.5 0 000-3zm6.207.293a1 1 0 00-1.414 0l-6 6a1 1 0 101.414 1.414l6-6a1 1 0 000-1.414zM12.5 10a1.5 1.5 0 100 3 1.5 1.5 0 000-3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="text-sm text-gray-500 font-semibold">Keringanan</div>
            </div>
        </div>

        <div>
            <small class="text-xs text-gray-500">
                Pemasukan
                <select name="" class="border-0 w-32 p-0 text-sm font-semibold">
                    @for ($i = 1; $i <= 12; $i++) <option value="{{ $i .'-'. date('Y') }}">
                        {{ tanggal($i, 'm') .' '. date('Y') }}</option>
                        @endfor
                </select>
            </small>
            <p class="text-4xl text-gray-700 font-extrabold">Rp 1.000.000</p>
        </div>

        <div class="flex flex-col space-y-4">
            <div>
                Pembayaran Terbaru
            </div>
            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-2">
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-200">
                        <span class="text-sm font-medium leading-none text-green-500">SPP</span>
                    </span>
                    <div>
                        <p class="font-semibold text-gray-700">Khoirul Azam</p>
                        <small class="text-xs text-gray-500">29-05-2022 05:00</small>
                    </div>
                </div>
                <div class="font-bold text-gray-800">3.850.000</div>
            </div>
            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-2">
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-200">
                        <span class="text-sm font-medium leading-none text-green-500">SPP</span>
                    </span>
                    <div>
                        <p class="font-semibold text-gray-700">Naura Fitria</p>
                        <small class="text-xs text-gray-500">29-05-2022 05:00</small>
                    </div>
                </div>
                <div class="font-bold text-gray-800">3.850.000</div>
            </div>
            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-2">
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-200">
                        <span class="text-sm font-medium leading-none text-green-500">SPP</span>
                    </span>
                    <div>
                        <p class="font-semibold text-gray-700">Afnan Taki</p>
                        <small class="text-xs text-gray-500">29-05-2022 05:00</small>
                    </div>
                </div>
                <div class="font-bold text-gray-800">3.850.000</div>
            </div>
            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-2">
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-200">
                        <span class="text-sm font-medium leading-none text-green-500">SPP</span>
                    </span>
                    <div>
                        <p class="font-semibold text-gray-700">Agus Fajri</p>
                        <small class="text-xs text-gray-500">29-05-2022 05:00</small>
                    </div>
                </div>
                <div class="font-bold text-gray-800">3.850.000</div>
            </div>
            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-2">
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-200">
                        <span class="text-sm font-medium leading-none text-green-500">SPP</span>
                    </span>
                    <div>
                        <p class="font-semibold text-gray-700">Ainal Muna</p>
                        <small class="text-xs text-gray-500">29-05-2022 05:00</small>
                    </div>
                </div>
                <div class="font-bold text-gray-800">3.850.000</div>
            </div>
        </div>
    </div>
</div>