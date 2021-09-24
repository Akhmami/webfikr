<div class="flex items-center space-x-1">
    <a href="#"
        onclick="Livewire.emit('openModal', 'dash.psb.gelombang-edit', {{ json_encode(['gelombang' => $data->id]) }})"
        title="edit"
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
</div>
