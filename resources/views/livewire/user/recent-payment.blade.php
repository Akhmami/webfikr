<div>
    <section aria-labelledby="recent-payment">
        <div class="py-2">
            <h2 class="text-base font-medium text-gray-900 mb-4">Histori pembayaran
            </h2>

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="bg-white divide-y-8 divide-gray-100">
                                    @foreach ($payments as $payment)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-xs text-gray-500 pb-1">
                                                ID Pembayaran
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $payment->payment_ntb }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-xs text-gray-500 pb-1">Tanggal</div>
                                            <div class="text-sm text-gray-900">
                                                {{ $payment->date_time }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-xs text-gray-500 pb-1">Deskripsi</div>
                                            <div class="text-sm text-gray-900">
                                                {{ $payment->billing->description }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="text-xs text-gray-500 pb-1">Nominal</div>
                                            <div class="text-sm text-yellow-600">
                                                {{ rupiah($payment->payment_amount) }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div>
                            {!! $payments->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
