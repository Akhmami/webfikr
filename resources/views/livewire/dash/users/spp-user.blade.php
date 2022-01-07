<div>
    <div class="bg-white">
        <div class="mb-4 font-medium">
            Komitmen SPP
        </div>
        <div class="mb-6 flex space-x-2">
            <div class="text-yellow-600 font-semibold">{{ $komitmen }}</div>
            <a href="#"
                onclick="Livewire.emit('openModal', 'dash.edit-value', {{ json_encode(['model' => 'SetSpp', 'id' => $user->setSpp->id ?? null, 'column' => 'nominal']) }})"
                class="p-1 rounded-md hover:bg-yellow-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hover:text-gray-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </a>
        </div>

        <div class="mb-4 font-medium">
            Daftar SPP Yang Sudah Ditunaikan
        </div>

        <div class="flex flex-col space-y-4">
            @foreach ($grades as $grade)
            <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                <div class="flex justify-between items-center">
                    <div class="px-4 py-5 sm:px-6">
                        Kelas {!! $grade->nama !!}
                    </div>
                    <div class="px-4 py-5 sm:px-6">
                        <button type="button" wire:click="minus({{ $grade->id }})"
                            class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <!-- Heroicon name: solid/minus-sm -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button type="button" wire:click="plus({{ $grade->id }})"
                            class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <!-- Heroicon name: solid/plus-sm -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    @if ($grade->spps()->where('user_id', $user->id)->count() > 0)
                    <div class="flex space-x-4">
                        @foreach ($grade->spps()->where('user_id', $user->id)->get()->chunk(4) as
                        $chunk)
                        <div class="flex flex-col space-y-2 flex-1">
                            @foreach ($chunk as $bln)
                            <div class="flex items-center p-2 rounded-full bg-blue-50">
                                <div class="h-5 flex items-center">
                                    <input type="checkbox" checked disabled
                                        class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300 rounded-full">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="candidates" class="font-medium text-gray-700">{{ tanggal(date('m',
                                        strtotime($bln->bulan)), 'm') }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    @else
                    <span class="text-gray-400 text-sm font-light">Tidak ada pembayaran</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
