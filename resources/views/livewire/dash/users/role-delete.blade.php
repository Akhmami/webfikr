<div>
    <x-alert-modal type="error">
        <x-slot name="title">Delete Role</x-slot>
        <x-slot name="description">
            Apakah yakin ingin menghapus data role terpilih?
        </x-slot>
        <x-slot name="buttons">
            <button type="button" wire:click="$emit('closeModal')"
                class="flex-1 mr-2 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                Cancel
            </button>
            <button type="button" wire:click="delete({{$role_id}})"
                class="flex-1 rounded-md border border-transparent shadow-sm px-8 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Yakin</button>
        </x-slot>
    </x-alert-modal>
</div>
