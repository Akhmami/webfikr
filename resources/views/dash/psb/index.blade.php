<x-dash-layout>
    <x-slot name="breadtitle">
        PSB
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto mb-6">
            <livewire:dash.psb.menu />
        </div>
        <div class="flex space-x-4">
            <div class="w-full">
                <div class="bg-white rounded-xl divide-y">
                    <div class="divide-y">
                        <div class="flex items-center justify-between px-4 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Data Pendaftar
                            </div>
                            <div class="flex items-center space-x-4">
                                <livewire:dash.psb.psb-stat-count type="pendaftar" />
                                <button type="button" onclick="Livewire.emit('openModal', 'dash.psb.download')"
                                    class="inline-flex items-center pl-3 pr-4 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>UNDUH EXCEL</span>
                                </button>
                            </div>
                        </div>
                        <div class="rounded-b flex flex-col px-4 py-4">
                            <livewire:dash.psb.registered-table />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @once
    @push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush
    @endonce
</x-dash-layout>
