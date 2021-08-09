<div>
    <section aria-labelledby="profile-overview-title">
        <div class="rounded-lg bg-white overflow-hidden shadow">
            <h2 class="sr-only" id="profile-overview-title">SPP Overview</h2>
            <div class="bg-white p-6">
                <div class="mb-4 font-medium">
                    Daftar SPP Yang Sudah Ditunaikan
                </div>

                <div class="flex flex-col space-y-4">
                    @foreach ($grades as $grade)
                    <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                        <div class="px-4 py-5 sm:px-6">
                            Kelas {!! $grade->nama !!}
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            @if ($grade->spps()->where('user_id', auth()->user()->id)->count() > 0)
                            <div class="flex space-x-4">
                                @foreach ($grade->spps()->where('user_id', auth()->user()->id)->get()->chunk(4) as
                                $chunk)
                                <div class="flex flex-col space-y-2 flex-1">
                                    @foreach ($chunk as $bln)
                                    <div class="flex items-center p-2 rounded-full bg-blue-50">
                                        <div class="h-5 flex items-center">
                                            <input type="checkbox" checked disabled
                                                class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300 rounded-full">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="candidates"
                                                class="font-medium text-gray-700">{{ tanggal(date('m', strtotime($bln->bulan)), 'm') }}</label>
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
    </section>
</div>
