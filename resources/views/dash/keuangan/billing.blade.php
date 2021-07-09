<x-dash-layout>
    <x-slot name="breadtitle">
        Billing
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div x-data="{isClose : true}" class="flex space-x-4">
            <div class="w-full">
                <!-- Tabel -->
                <div class="bg-white rounded divide-y border">
                    <div class="flex items-center justify-between p-2">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Manajemen Billing
                        </div>
                        <button type="button" onclick="Livewire.emit('openModal', 'dash.keuangan.billing-name')"
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
                        <livewire:dash.keuangan.billings-table />
                    </div>
                </div>
            </div>

            <div x-show="isClose" class="w-2/6">
                <div>
                    <div class="mb-2 flex items-center justify-between py-1">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Balance
                        </div>
                        <button @click="isClose = false" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
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
                                <p class="text-xs text-gray-500">
                                    Pemasukan
                                    <select name="" class="border-0 w-28 p-0 text-xs font-semibold">
                                        @for ($i = 1; $i <= 12; $i++) <option value="{{ $i .'-'. date('Y') }}">
                                            {{ tanggal($i, 'm') .' '. date('Y') }}</option>
                                            @endfor
                                    </select>
                                </p>
                                <p class="text-xl text-gray-700 font-semibold">Rp 500.000.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-dash-layout>
