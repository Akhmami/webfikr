<div>
    <div class="flex space-x-2 flex-nowrap">
        <a href="#" onclick="Livewire.emit('openModal', 'dash.keuangan.export-modal')"
            class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-green-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">Ekspor ke excel</p>
                </div>
            </div>
        </a>
        <a href="{{ route('dash.keuangan.report') }}" class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-indigo-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">Report</p>
                </div>
            </div>
        </a>

        <a href="{{ route('dash.keuangan.webhook') }}" class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-blue-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">Webhook masuk</p>
                </div>
            </div>
        </a>

        <a href="{{ route('dash.keuangan.spp-failed') }}"
            class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-red-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">SPP gagal dibuat</p>
                </div>
            </div>
        </a>
    </div>
</div>
