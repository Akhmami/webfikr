<div>
    <x-modal action="update({{ $role_id }})">
        <x-slot name="title">
            Edit Role
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-4">
                <x-input label="Nama Role" name="name" livewire />
            </div>
            <div class="mt-4 mb-2">Permission/bisa ngakses apa aja:</div>
            <div class="flex">
                @php
                $limit = ceil($all_permissions->count()/2);
                @endphp
                @foreach ($all_permissions->chunk($limit) as $chunk)
                <div class="flex flex-col space-y-1 flex-1">
                    @foreach ($chunk as $item)
                    <div class="flex items-center">
                        <div class="h-5 flex items-center">
                            <input wire:model="permissions" type="checkbox" value="{{$item->name}}"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="candidates" class="font-medium text-gray-700">{{$item->name}}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="buttons">
            <button type="submit"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Update
            </button>
            <button type="button" wire:click="$emit('closeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2
                focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </x-slot>
    </x-modal>
</div>
