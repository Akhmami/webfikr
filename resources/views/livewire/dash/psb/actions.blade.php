<div class="flex items-center space-x-1">
    <a href="{{ route('dash.website.edit', ['item' => 'posts', 'id' => $data->id]) }}" title="edit"
        class="group p-2 border border-transparent rounded-full shadow-sm text-white bg-gray-200 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
        <!-- Heroicon name: solid/edit-alt -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 group-hover:text-white" viewBox="0 0 20 20"
            fill="currentColor">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
            <path fill-rule="evenodd"
                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                clip-rule="evenodd" />
        </svg>
    </a>

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
                {{-- <a href="#"
                    onclick="Livewire.emit('openModal', 'dash.keuangan.billing-detail', {{ json_encode(['billing' => $data->id]) }})"
                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1"
                id="menu-item-1">Detail</a> --}}
            </div>
        </div>
    </div>
</div>
