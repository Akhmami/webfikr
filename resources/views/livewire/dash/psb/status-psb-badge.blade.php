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

<div class="flex items-center">
    <span
        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{$color[$data->status_psb_id]}}-100 text-{{$color[$data->status_psb_id]}}-800">
        {{ $text[$data->status_psb_id] }}
    </span>

    @if ($data->questionnaire_psb === 1)
    <a href="#"
        onclick="Livewire.emit('openModal', 'dash.questionnaire-answered', {{ json_encode(['user' => $data]) }})"
        title="Questionnaire terisi">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
        </svg>
    </a>
    @endif
</div>
