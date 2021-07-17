<div>
    <x-alert-modal type="error">
        <x-slot name="title">Oops...!</x-slot>
        <x-slot name="description">
            {{ $message }}
        </x-slot>
        <x-slot name="buttons">
            <button type="button" wire:click="$emit('closeModal')" class="rounded-md border border-transparent shadow-sm px-8 py-2 bg-blue-600 text-base font-medium
                text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                sm:text-sm">Close</button>
        </x-slot>
    </x-alert-modal>
</div>
