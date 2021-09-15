<div>
    <ul class="divide-y divide-gray-200">
        @if ($data->billers->count() > 0)
        @foreach ($data->billers()->latest('id')->limit(3)->get() as $biller)
        <li>
            <div class="flex justify-between py-2">
                <div class="text-sm text-gray-900">{{ $biller->type }}</div>
                <div class="text-sm text-gray-500 flex items-center">
                    <span>{{ rupiah(($biller->amount - $biller->sum_cost_reductions), false) }}</span>
                    @if ($biller->sum_cost_reductions > 0)
                    <span class="text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                    @endif
                </div>
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
