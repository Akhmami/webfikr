@if (!empty($data->balance))
<div class="flex items-center space-x-1">
    <span
        class="text-grey-900 font-semibold hover:underline cursor-pointer">{{ rupiah($data->balance->current_amount) }}</span>
    <a href="#"
        onclick="Livewire.emit('openModal', 'dash.keuangan.edit-saldo', {{ json_encode(['balance' => $data->balance->id]) }})"
        class="p-1 rounded-md hover:bg-yellow-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hover:text-gray-900" viewBox="0 0 20 20"
            fill="currentColor">
            <path
                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
    </a>
</div>
@else
<span class="text-grey-900 font-semibold hover:underline cursor-pointer">0</span>
@endif
