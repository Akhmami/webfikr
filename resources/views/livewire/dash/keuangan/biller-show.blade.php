<div>
    <div class="prose px-10 py-6">
        <h4>Pilih Biaya Yang Ingin Dikurangi!</h4>
        <div class="divide-y divide-gray-200">
            @foreach ($user->activeBillers as $biller)
            <div class="py-2">
                <p class="text-sm font-medium text-gray-900">{{ $biller->type .' (' . $biller->description . ')' }}
                </p>
                <ul class="text-sm text-gray-500">
                    @foreach ($biller->billerDetails as $item)
                    <li class="cursor-pointer hover:text-blue-500 hover:underline"
                        onclick="Livewire.emit('openModal', 'dash.keuangan.cost-reduction-create', {{ json_encode(['item_id' => $item->id, 'user_id' => $user->id]) }})">
                        {{ $item->nama .' (' . rupiah($item->nominal) . ')' }}</li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
