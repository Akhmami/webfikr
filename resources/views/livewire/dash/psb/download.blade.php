<div>
    <x-modal action="export">
        <x-slot name="title">
            Dapatkan data excel
        </x-slot>

        <x-slot name="content">
            <x-select label="Tahun Pendaftaran" name="tahun_pendaftaran" :list="$year" livewire />
        </x-slot>

        <x-slot name="buttons">
            <button type="submit" wire:loading.remove wire:target="export"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Dapatkan excel
            </button>
            <span wire:loading wire:target="export"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium sm:ml-3 sm:w-auto sm:text-sm">Processing...</span>
            <button type="button" wire:loading.remove wire:target="export" wire:click="$emit('closeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                    bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </x-slot>
    </x-modal>
</div>