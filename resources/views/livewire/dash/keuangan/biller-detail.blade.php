<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Detail Billing
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Informasi tagihan, rincian tagihan dan histori pembayaran
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nama Lengkap
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $billing->user->name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Jenis Kelamin
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $billing->user->gender === 'L' ? 'Laki-laki' : 'Perempuaan' }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Billing ID
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $billing->trx_id }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Virtual Account
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $billing->virtual_account }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Jumlah Tagihan
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <div class="font-semibold mb-4">{{ $billing->amount }}</div>
                        @foreach ($billing->billingDetails as $item)
                        <div>
                            <span>{{ $item->nama }}</span>
                            <span>{{ $item->nominal }}</span>
                        </div>
                        @endforeach
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Histori Pembayaran
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if ($billing->paymentHistories()->count() > 0)
                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @foreach ($billing->paymentHistories as $item)
                            <li class="p-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <span class="flex-1 w-0 truncate">
                                        {{ $item->payment_amount }}
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <span class="font-medium text-indigo-600">
                                        {{ $item->datetime_payment }}
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <span>Belum ada pembayaran</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
