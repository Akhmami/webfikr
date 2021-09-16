<div class="flex items-center space-x-1">
    <div x-data="{ isOn: false }" class="relative inline-block text-left pl-2">
        <div>
            <button @click="isOn = !isOn" type="button" :class="{ 'bg-gray-100' : isOn }"
                class="rounded-full flex items-center text-gray-600 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span class="sr-only">Open options</span>
                <!-- Heroicon name: solid/dots-vertical -->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path
                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                </svg>
            </button>
        </div>
        <div x-show="isOn" @click.away="isOn = false"
            class="z-10 origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <a href="#"
                    onclick="Livewire.emit('openModal', 'dash.keuangan.cost-reduction-edit', {{ json_encode(['reduction' => $data->id]) }})"
                    class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1"
                    id="menu-item-1">edit</a>
                <a href="#"
                    onclick="Livewire.emit('openModal', 'dash.keuangan.cost-reduction-delete', {{ json_encode(['reduction' => $data->id]) }})"
                    class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1"
                    id="menu-item-1">hapus</a>
            </div>
        </div>
    </div>
</div>
