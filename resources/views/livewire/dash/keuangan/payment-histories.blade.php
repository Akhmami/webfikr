<div>
    <div class="mb-2 flex items-center justify-between py-1">
        <div class="text-md font-medium uppercase text-gray-700">
            Riwayat Pembayaran Terbaru
        </div>
    </div>
    <div class="flex flex-col space-y-2">
        @foreach ($payments as $payment)
        <div class="bg-white rounded shadow">
            <div class="flex items-center space-x-4 p-4">
                <div class="rounded-full bg-green-100 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">
                        {{ $payment->customer_name }}
                    </p>
                    <p class="text-xl text-gray-700 font-semibold">{{ rupiah($payment->payment_amount) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
