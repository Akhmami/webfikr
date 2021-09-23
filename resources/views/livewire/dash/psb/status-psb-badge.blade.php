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

<span
    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{$color[$data->status_psb_id]}}-100 text-{{$color[$data->status_psb_id]}}-800">
    {{ $text[$data->status_psb_id] }}
</span>
