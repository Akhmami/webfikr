<div>
    <x-modal action="bayar">
        <x-slot name="title">
            Proses Pembayaran
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-6">
                <div class="text-left">
                    <span class="text-sm text-gray-500">Jumlah Tagihan</span>
                    <div class="mt-1 font-bold text-lg text-gray-700">{{ rupiah($max_amount) }}</div>
                </div>
                <div>

                    @if ($total_balance > 0)
                    <span>Gunakan Saldo</span>
                    <div class="flex gap-4 flex-wrap mt-2 mb-4">
                        <label class="flex flex-col cursor-pointer">
                            <div class="flex items-center text-sm">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" wire:model.lazy="balance" value="{{ $total_balance }}"
                                        class="form-checkbox rounded-md h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span
                                        class="ml-2 text-gray-700 font-semibold text-md">{{ rupiah($total_balance) }}</span>
                                </label>
                            </div>
                        </label>
                    </div>
                    @endif

                    <div class="mt-4 bg-indigo-100 rounded-md p-4 flex flex-col items-center justify-center">
                        <div class="text-sm text-gray-500">Total Bayar</div>
                        <div class="text-indigo-700 text-2xl font-semibold">
                            {{ rupiah($total_pay) }}</div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="buttons">
            <button type="submit" wire:loading.remove wire:target="add"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Bayar Sekarang
            </button>
            <span wire:loading wire:target="add"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium sm:ml-3 sm:w-auto sm:text-sm">Processing...</span>
            <button type="button" wire:click="$emit('closeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                    bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </x-slot>
    </x-modal>
</div>
