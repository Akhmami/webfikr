<div>
    <section aria-labelledby="profile-overview-title">
        <div class="rounded-lg bg-white overflow-hidden shadow">
            <h2 class="sr-only" id="profile-overview-title">Billing Overview</h2>
            <div class="bg-white p-6">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div class="sm:flex items-center sm:space-x-5">
                        <div class="flex-shrink-0 text-center sm:text-left">
                            <div class="inline-flex items-center p-5 rounded-full bg-yellow-50">
                                <!-- Heroicon name: outline/clock -->
                                <svg class="h-10 w-10 text-yellow-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                            <p class="text-xl font-bold text-gray-900 sm:text-2xl">
                                {{ rupiah($total_amount) }}</p>
                            <p class="text-sm font-medium text-gray-600">
                                {{ $description }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 flex justify-center sm:mt-0">
                        <button type="button" onclick="Livewire.emit('openModal', 'user.rincian-tagihan')"
                            class="flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700">
                            Rincian Tagihan
                        </button>
                    </div>
                </div>
            </div>
            <div
                class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                <div class="px-6 py-5 text-sm font-medium text-center">
                    <span class="text-gray-600">Tagihan berikutnya
                        {{ date_range(date('Y-m-d'), date('Y-m-01', strtotime('next month')), '%d') }}
                        hari</span>
                </div>

                <div class="col-span-2 px-6 py-5 text-sm font-medium text-center">
                    <span class="text-gray-600">Tagihan jatuh tempo akan di akumulasikan ke tagihan
                        berikutnya</span>
                </div>
            </div>
        </div>
    </section>
</div>
