<div>
    <!-- Tabel -->
    <div>
        <div class="mb-2 flex items-center justify-between">
            <div class="text-md font-medium uppercase text-gray-700">
                Manajemen billing
            </div>
            <button type="button" onclick="Livewire.emit('openModal', 'dash.users.role-create')"
                class="inline-flex items-center pl-2 pr-3 py-1 border border-transparent text-xs font-medium rounded text-blue-700 hover:bg-blue-600 hover:text-white hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                <span>NEW</span>
            </button>
        </div>
        <div class="bg-white rounded border">
            <div>
                <div class="sm:hidden">
                    <label for="tabs" class="sr-only">Select a tab</label>
                    <select id="tabs" name="tabs"
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option selected>Histori Pembayaran</option>

                        <option>Billing</option>
                    </select>
                </div>
                <div class="hidden sm:block">
                    <div class="border-b border-gray-200 px-2">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <a href="#" wire:click.prevent="tabMenu('history')"
                                class="{{ $active === 'history' ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }} whitespace-nowrap py-4 px-1 font-medium text-sm"
                                aria-current="page">
                                Histori Pembayaran
                            </a>

                            <a href="#" wire:click.prevent="tabMenu('billing')"
                                class="{{ $active === 'billing' ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }} whitespace-nowrap py-4 px-1 font-medium text-sm">
                                Billing Data
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="rounded-b flex flex-col px-2 py-4">
                @if ($active === 'history')
                <livewire:dash.keuangan.payment-histories-table />
                @else
                <livewire:dash.keuangan.billings-table />
                @endif
            </div>
        </div>
    </div>
</div>
