<div>
    <x-modal action="create">
        <x-slot name="title">
            Buat Keringanan Biaya <span class="text-blue-500">{{ $name }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-4">
                <div>
                    {{ $item->nama . ' - ' . rupiah($item->nominal) }}
                </div>

                <x-input type="hidden" name="type" livewire />

                <div class="flex items-center space-x-2">
                    <x-input label="Keterangan" name="keterangan" livewire />
                    <x-input label="Nominal" name="nominal" livewire />
                </div>
            </div>
        </x-slot>

        <x-slot name="buttons">
            <button type="submit"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Create
            </button>
            <button type="button" wire:click="$emit('closeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2
                focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </x-slot>
    </x-modal>
</div>