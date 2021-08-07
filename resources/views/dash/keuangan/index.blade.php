<x-dash-layout>
    <x-slot name="breadtitle">
        Keuangan
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div x-data="{isClose : true}" class="flex space-x-4">
            <div class="w-full">

                <div x-data="{ tab: window.location.hash ? window.location.hash : '#tagihan' }"
                    class="bg-white rounded divide-y border">
                    <div>
                        <div class="sm:hidden">
                            <label for="tabs" class="sr-only">Select a tab</label>
                            <select id="tabs" name="tabs"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option selected>Tagihan</option>

                                <option>Virtual Account</option>

                                <option>Lainnya</option>
                            </select>
                        </div>
                        <div class="hidden sm:block">
                            <div>
                                <nav class="-mb-px flex" aria-label="Tabs">
                                    <a href="#" x-on:click.prevent="tab='#tagihan'"
                                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#tagihan' }"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-indigo-500 border-b-2 whitespace-nowrap flex py-4 px-6 font-medium text-sm">
                                        <span>Tagihan</span>

                                        <span :class="{ 'bg-indigo-100 text-indigo-600' : tab === '#tagihan' }"
                                            class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">
                                            {{ $tagihan }}
                                        </span>
                                    </a>

                                    <a href="#" x-on:click.prevent="tab='#virtual-account'"
                                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#virtual-account' }"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-indigo-500 border-b-2 whitespace-nowrap flex py-4 px-6 font-medium text-sm"
                                        aria-current="page">
                                        <span>Virtual Account</span>

                                        <span :class="{ 'bg-indigo-100 text-indigo-600' : tab === '#virtual-account' }"
                                            class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">
                                            {{ $virtual_account }}
                                        </span>
                                    </a>

                                    <a href="#" x-on:click.prevent="tab='#keringanan'"
                                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#keringanan' }"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-indigo-500 border-b-2 whitespace-nowrap flex py-4 px-6 font-medium text-sm">
                                        <span>Keringanan</span>

                                        <span :class="{ 'bg-indigo-100 text-indigo-600' : tab === '#keringanan' }"
                                            class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">
                                            {{ $keringanan }}
                                        </span>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Tagihan -->
                    <div class="divide-y" x-show="tab == '#tagihan'" x-cloak>
                        <div class="flex items-center justify-between px-2 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Daftar Tagihan
                            </div>
                            <button type="button"
                                onclick="Livewire.emit('openModal', 'dash.get-name', {{ json_encode(['title' => 'Tambah Tagihan', 'path' => 'dash.keuangan.biller-create']) }})"
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
                            <livewire:dash.keuangan.billers-table />
                        </div>
                    </div>
                    <!-- Tab Billing -->
                    <div class="divide-y" x-show="tab == '#virtual-account'" x-cloak>
                        <div class="flex items-center justify-between px-2 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Daftar Virtual Account
                            </div>
                            {{-- <button type="button"
                                onclick="Livewire.emit('openModal', 'dash.get-name', {{ json_encode(['title' => 'Tambah Virtual Account', 'path' => 'dash.keuangan.billing-create']) }})"
                            class="inline-flex items-center pl-3 pr-4 py-1.5 border border-transparent text-xs
                            font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none
                            focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>NEW</span>
                            </button> --}}
                        </div>
                        <div class="rounded-b flex flex-col px-2 py-4">
                            <livewire:dash.keuangan.billings-table />
                        </div>
                    </div>
                    <!-- Tab Keringanan -->
                    <div class="divide-y" x-show="tab == '#keringanan'" x-cloak>
                        <div class="flex items-center justify-between px-2 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Daftar Keringanan Biaya
                            </div>
                            <button type="button"
                                onclick="Livewire.emit('openModal', 'dash.get-name', {{ json_encode(['title' => 'Tambah Keringanan Biaya', 'path' => 'dash.keuangan.biller-show' ]) }})"
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
                            <livewire:dash.keuangan.cost-reductions-table />
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="isClose" class="w-2/6">
                <livewire:dash.keuangan.balance />
                <livewire:dash.keuangan.payment-histories />
            </div>
        </div>
    </main>
</x-dash-layout>
