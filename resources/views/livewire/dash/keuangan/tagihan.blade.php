<div>
    <ul class="divide-y divide-gray-200">
        @if ($data->billers()->count() > 0)
        @foreach ($data->billers()->take(3)->get() as $biller)
        <li>
            <div class="flex justify-between py-2">
                <div class="text-sm text-gray-900">{{ $biller->type }}</div>
                <div class="text-sm text-gray-500">{{ rupiah($biller->amount, false) }}</div>
                <div class="text-sm text-gray-500">
                    @include('livewire.dash.keuangan.status-biller')
                </div>
                <div class="text-sm">
                    @include('livewire.dash.keuangan.actions')
                </div>
            </div>
        </li>
        @endforeach
        @else
        <li class="text-center text-gray-500">
            <p>Tagihan tidak tersedia</p>
        </li>
        @endif
    </ul>
</div>
