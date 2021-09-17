<div>
    <div class="prose px-10 py-6">
        <div class="divide-y divide-gray-200">
            @if ($user->activeBillers->count() > 0)
            <h4>Pilih Biaya Yang Ingin Dikurangi!</h4>
            @foreach ($user->activeBillers as $biller)
            <div class="py-2">
                <p class="text-sm font-medium text-gray-900">{{ $biller->type .' (' . $biller->description . ')' }}
                </p>
                <ul class="text-sm text-gray-500">
                    @foreach ($biller->billerDetails as $item)
                    <li class="cursor-pointer hover:text-blue-500 hover:underline"
                        onclick="Livewire.emit('openModal', 'dash.keuangan.cost-reduction-create', {{ json_encode(['item_id' => $item->id, 'user_id' => $user->id]) }})">
                        {{ $item->nama .' (' . rupiah($item->nominal) . ')' }}
                        @if ($item->keringanan > 0)
                        <span class="text-red-500">ada keringanan ({{rupiah($item->nominal)}})</span>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
            @else
            Tidak tersedia tagihan aktif
            @endif
        </div>
    </div>
</div>
