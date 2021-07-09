<div>
    @foreach ($roles as $role)
    <x-badge color="red" :text="$role->name">
        <button type="button" title="Edit"
            onclick="Livewire.emit('openModal', 'dash.users.role-edit', {{ json_encode(['role' => $role->id]) }})"
            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white">
            <span class="sr-only">Edit</span>
            <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
        </button>
        <button type="button" title="Hapus"
            onclick="Livewire.emit('openModal', 'dash.users.role-delete', {{ json_encode(['role' => $role->id]) }})"
            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white">
            <span class="sr-only">Delete</span>
            <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
            </svg>
        </button>
    </x-badge>
    @endforeach
</div>
