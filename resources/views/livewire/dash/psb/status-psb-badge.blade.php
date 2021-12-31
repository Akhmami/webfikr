@php
$color = [
1 => 'red',
2 => 'green',
3 => 'blue',
4 => 'yellow',
5 => 'gray',
6 => 'gray'
];

$text = [
1 => 'menunggu',
2 => 'terbayar',
3 => 'diterima',
4 => 'cadangan',
5 => 'tidak diterima',
6 => 'mundur'
];
@endphp

<div class="flex flex-col items-start space-y-1">
    <div class="flex items-center">
        <span
            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{$color[$data->status_psb_id]}}-100 text-{{$color[$data->status_psb_id]}}-800">
            {{ $text[$data->status_psb_id] }}
        </span>
        <a href="#"
            onclick="Livewire.emit('openModal', 'dash.edit-value', {{ json_encode(['model' => 'User', 'id' => $data->id, 'column' => 'status_psb_id', 'type' => 'status-psb']) }})"
            class="p-1 rounded-md hover:bg-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hover:text-gray-900"
                viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
        </a>
    </div>

    @if ($data->questionnaire_psb === 1)
    <a href="#"
        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"
        onclick="Livewire.emit('openModal', 'dash.questionnaire-answered', {{ json_encode(['user' => $data]) }})"
        title="Questionnaire terisi">
        questionnaire
        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 text-green-500" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
        </svg>
    </a>
    @endif
</div>
