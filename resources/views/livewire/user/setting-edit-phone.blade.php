<div>
    <x-modal action="update">
        <x-slot name="title">
            Edit Nomor Telepon
        </x-slot>

        <x-slot name="content">
            <x-input label="Nama Pemilik" name="name" livewire />
            <div class="mt-4">
                <label for="number" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center w-20">
                        <label for="country" class="sr-only">Country</label>
                        <select id="country" wire:model="country_code"
                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-3 pr-5 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                            @foreach ($countries as $key => $value)
                            <option value="{{ $key }}">{{ $value }} ({{ $key }})</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" wire:model="number" id="number"
                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-20 sm:text-sm border-gray-300 rounded-md"
                        placeholder="877 8077 5548">
                </div>
                @error('number')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </x-slot>

        <x-slot name="buttons">
            <button type="submit" wire:loading.remove wire:target="update"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Update
            </button>
            <span wire:loading wire:target="update"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium sm:ml-3 sm:w-auto sm:text-sm">Processing...</span>
            <button type="button" wire:click="$emit('closeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                    bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </x-slot>
    </x-modal>
</div>
