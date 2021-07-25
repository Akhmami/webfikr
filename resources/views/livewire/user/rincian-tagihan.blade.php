<div>
    <x-modal>
        <x-slot name="title">
            Daftar Tagihan
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-2">
                @foreach ($user->activeBillers as $biller)
                <div class="p-4 bg-gray-100 rounded-md">
                    <div class="flex items-center space-x-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-md font-semibold text-gray-900 truncate">
                                {{ rupiah(($biller->amount - $biller->cumulative_payment_amount)) }}
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                                {{ $biller->description }}
                            </p>
                        </div>
                        <div>
                            @if ($biller->activeBillings()->count() > 0)
                            <a href="{{ route('user.pembayaran') }}"
                                class="inline-flex items-center px-3 text-sm font-medium text-indigo-600">
                                Lihat pembayaran
                            </a>
                            @else
                            <button type="button" wire:click="bayar({{ $biller->id }})"
                                class="inline-flex items-center px-3 py-1 border border-transparent shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700' rounded-full">
                                Bayar Sekarang
                            </button>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="buttons">
            <button type="button" wire:click="$emit('closeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                    bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Close
            </button>
        </x-slot>
    </x-modal>
</div>
