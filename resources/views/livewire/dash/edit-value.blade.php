<div>
    <x-modal action="update">
        <x-slot name="title">
            Edit Field
        </x-slot>

        <x-slot name="content">
            @if ($type === 'jk')
            @php
            $type = [
            'L' => 'Laki-laki',
            'P' => 'Perempuan'
            ]
            @endphp

            <x-select label="Jenis kelamin" name="value" :list="$type" livewire />
            @elseif ($type === 'status-psb')
            @php
            $type = [
            3 => 'Diterima',
            4 => 'Cadangan',
            5 => 'Tidak Diterima',
            6 => 'Mengundurkan Diri'
            ]
            @endphp

            <x-select label="Status PSB" name="value" :list="$type" livewire />
            @else
            <x-input label="{{ $column }}" name="value" livewire />
            @endif
        </x-slot>

        <x-slot name="buttons">
            <button type="submit" wire:loading.remove wire:target="update"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Update
            </button>
            <span wire:loading wire:target="update"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium sm:ml-3 sm:w-auto sm:text-sm">Processing...</span>
            <button type="button" wire:loading.remove wire:target="update" wire:click="$emit('closeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                    bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </x-slot>
    </x-modal>
</div>
