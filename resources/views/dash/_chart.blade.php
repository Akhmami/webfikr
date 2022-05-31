<div class="flex-1">
    <div class="text-md font-medium uppercase text-gray-700 mb-2">
        Statistik Pengunjung
    </div>
    <div class="mb-6 bg-white rounded-xl flex items-center h-auto">
        <div class="overflow-hidden w-full md:flex" style="max-width:900px" x-data="{stockTicker:stockTicker()}"
            x-init="stockTicker.renderChart()">
            <div class="flex flex-col w-full md:w-3/4 pl-6 py-6 bg-white text-white rounded-xl">
                <div class="flex justify-between pr-4 pl-1 mb-4">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
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
                <div class="w-full h-full bg-blue-500 rounded-xl flex flex-col items-center justify-center space-y-2">
                    <h3 class="text-lg font-semibold leading-tight text-gray-100">Hari ini</h3>
                    <div class="text-gray-100 text-4xl font-bold">{{ mt_rand(1, 20) }}</div>
                    <div class="text-gray-100 text-sm">Pengunjung</div>
                </div>
            </div>
        </div>
    </div>
</div>