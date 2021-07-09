<div>
    <x-modal action="create">
        <x-slot name="title">
            Buat user baru
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-4">
                <x-input label="Nama Lengkap" name="name" livewire />
                <x-input label="E-mail" name="email" livewire />
                <x-input label="Username" name="username" livewire />
                <x-input label="Password" type="password" name="password" livewire />
                <x-input label="Ketik Ulang Password" type="password" name="password_confirmation" livewire />
            </div>
            <div class="mt-4">Role/Jenis Pengguna:</div>
            @foreach ($all_roles as $item)
            @if ($item->name !== 'super-admin')
            <div>
                <div class="flex items-start">
                    <div class="h-5 flex items-center">
                        <input wire:model="roles" type="checkbox" value="{{$item->name}}"
                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="candidates" class="font-medium text-gray-700">{{$item->name}}</label>
                        <p class="text-gray-500">Bisa:
                            @foreach ($item->permissions as $permission)
                            <x-badge color="green" :text="$permission->name" />
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
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
