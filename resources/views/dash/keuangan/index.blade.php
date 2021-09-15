<x-dash-layout>
    <x-slot name="breadtitle">
        Keuangan <span class="tooltip-toggle" aria-label="Sample text for your tooltip!" tabindex="0">
            <svg viewBox="0 0 27 27" xmlns="http://www.w3.org/2000/svg">
                <g fill="#ED3E44" fill-rule="evenodd">
                    <path
                        d="M13.5 27C20.956 27 27 20.956 27 13.5S20.956 0 13.5 0 0 6.044 0 13.5 6.044 27 13.5 27zm0-2C7.15 25 2 19.85 2 13.5S7.15 2 13.5 2 25 7.15 25 13.5 19.85 25 13.5 25z" />
                    <path
                        d="M12.05 7.64c0-.228.04-.423.12-.585.077-.163.185-.295.32-.397.138-.102.298-.177.48-.227.184-.048.383-.073.598-.073.203 0 .398.025.584.074.186.05.35.126.488.228.14.102.252.234.336.397.084.162.127.357.127.584 0 .22-.043.412-.127.574-.084.163-.196.297-.336.4-.14.106-.302.185-.488.237-.186.053-.38.08-.584.08-.215 0-.414-.027-.597-.08-.182-.05-.342-.13-.48-.235-.135-.104-.243-.238-.32-.4-.08-.163-.12-.355-.12-.576zm-1.02 11.517c.134 0 .275-.013.424-.04.148-.025.284-.08.41-.16.124-.082.23-.198.313-.35.085-.15.127-.354.127-.61v-5.423c0-.238-.042-.43-.127-.57-.084-.144-.19-.254-.318-.332-.13-.08-.267-.13-.415-.153-.148-.024-.286-.036-.414-.036h-.21v-.95h4.195v7.463c0 .256.043.46.127.61.084.152.19.268.314.35.125.08.263.135.414.16.15.027.29.04.418.04h.21v.95H10.82v-.95h.21z" />
                </g>
            </svg>
        </span>
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto mb-6">
            <livewire:dash.keuangan.menu />
        </div>
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
                                            <x-tooltip message="belum dibayar" :title="$tagihan" />
                                        </span>
                                    </a>

                                    <a href="#" x-on:click.prevent="tab='#virtual-account'"
                                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#virtual-account' }"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-indigo-500 border-b-2 whitespace-nowrap flex py-4 px-6 font-medium text-sm"
                                        aria-current="page">
                                        <span>Virtual Account</span>

                                        <span title="active"
                                            :class="{ 'bg-indigo-100 text-indigo-600' : tab === '#virtual-account' }"
                                            class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">
                                            <x-tooltip message="VA active" :title="$virtual_account" />
                                        </span>
                                    </a>

                                    <a href="#" x-on:click.prevent="tab='#riwayat-pembayaran'"
                                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#riwayat-pembayaran' }"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-indigo-500 border-b-2 whitespace-nowrap flex py-4 px-6 font-medium text-sm">
                                        <span>Riwayat Pembayaran</span>

                                        <span title="Hari ini"
                                            :class="{ 'bg-indigo-100 text-indigo-600' : tab === '#riwayat-pembayaran' }"
                                            class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">
                                            <x-tooltip message="pembayaran hari ini" :title="$history" />
                                        </span>
                                    </a>

                                    <a href="#" x-on:click.prevent="tab='#keringanan'"
                                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#keringanan' }"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-indigo-500 border-b-2 whitespace-nowrap flex py-4 px-6 font-medium text-sm">
                                        <span>Keringanan</span>
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
                    <!-- Tab riwayat pembayaran -->
                    <div class="divide-y" x-show="tab == '#riwayat-pembayaran'" x-cloak>
                        <div class="flex items-center justify-between px-2 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Daftar Riwayat Pembayaran
                            </div>
                        </div>
                        <div class="rounded-b flex flex-col px-2 py-4">
                            <livewire:dash.keuangan.payment-histories-table />
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
                {{-- <div>
                    <div class="mb-2 flex items-center justify-between py-1">
                        <div class="text-md font-medium uppercase text-gray-700">
                            Riwayat Pembayaran Terbaru
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2">
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
                                        <x-badge color="gray" text="dfg" />
                                        Fulan Ahmad
                                    </p>
                                    <p class="text-xl text-gray-700 font-semibold">1.000.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </main>
</x-dash-layout>
