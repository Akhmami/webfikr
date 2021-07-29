<div>
    <x-modal action="add">
        <x-slot name="title">
            Isi Saldo
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-6">
                <div>
                    <span>Pilihan Saldo</span>
                    <div class="flex gap-4 flex-wrap mt-2">
                        @for ($i = 1; $i <= 12; $i++) <label
                            class="border-gray-200 rounded-md border p-4 flex flex-col cursor-pointer">
                            <div class="flex items-center text-sm">
                                <input type="radio" wire:model.lazy="trx_amount" value="{{ ($i * 1000000) }}"
                                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <span id="pricing-plans-0-label"
                                    class="text-gray-900 ml-3 font-medium">{{ rupiah(($i * 1000000)) }}</span>
                            </div>
                            </label>
                            @endfor
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="buttons">
            <button type="submit"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Isi Sekarang
            </button>
            <button type="button" wire:click="$emit('closeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                    bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </x-slot>
    </x-modal>
</div>
