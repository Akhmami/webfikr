<div>
    <x-modal action="bayar">
        <x-slot name="title">
            Proses Pembayaran
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-6">
                <div class="text-left">
                    <span class="text-xs text-gray-500">Jumlah Pembayaran</span>
                    <div class="mt-1 font-bold text-2xl text-yellow-600">{{ rupiah($max_amount) }}</div>
                </div>
                <div>
                    <span>Pilihan Pembayaran</span>
                    <div class="flex gap-4 flex-wrap mt-2">
                        @php
                        $id = 1;
                        @endphp
                        @foreach ($options as $item)
                        <label class="border-gray-200 rounded-md border p-4 flex flex-col cursor-pointer">
                            <div class="flex items-center text-sm">
                                <input type="radio" wire:model.lazy="option_id" value="{{ $id }}"
                                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <span id="pricing-plans-0-label"
                                    class="text-gray-900 ml-3 font-medium">{{ rupiah($item['value']) }}</span>
                            </div>
                            @if ($biller['type'] === 'SPP')
                            <p id="pricing-plans-0-description-1"
                                class="text-gray-500 ml-6 pl-1 text-sm md:ml-0 md:pl-0 md:text-right">
                                {{ $item['description'] }}</p>
                            @endif
                        </label>
                        @php
                        $id++;
                        @endphp
                        @endforeach
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
