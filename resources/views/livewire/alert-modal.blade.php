<div>
    <x-alert-modal :type="$status">
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">
            {{ $description }}
        </x-slot>
        <x-slot name="buttons">
            <button type="button" wire:click="close"
                class="rounded-md border border-transparent shadow-sm px-8 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Close</button>
        </x-slot>
    </x-alert-modal>
</div>
