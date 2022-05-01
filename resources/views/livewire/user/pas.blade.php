<div>
    <section aria-labelledby="profile-overview-title">
        <div class="rounded-lg bg-white overflow-hidden shadow">
            <h2 class="sr-only" id="profile-overview-title">SPP Overview</h2>
            <div class="bg-white p-6">
                <div class="mb-4 font-medium">
                    Penilaian Akhir Semester
                </div>

                <div>
                    @if ($allow)
                    <div class="rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800">
                                    Akses PAS Terbuka
                                </h3>
                                <div class="mt-2 text-sm text-green-700">
                                    <p>
                                        Terimakasih atas pengertiannya telah menyelesaikan administrasi, berikut ini
                                        adalah akses akun aplikasi <a href="//e-ujian.com/nfbs_serang">CBT E-ujian</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center mt-8">
                        <div
                            class="relative border-2 border-gray-300 border-dashed rounded-lg text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <div style="width: 32rem;" class="bg-white h-60 rounded shadow-md flex">
                                <img class="pt-4 w-auto h-1/2 rounded-l-sm" src="{{ asset('images/man.png') }}" alt="Room Image">
                                <div class="w-full pl-4">
                                    <div class="p-4 pb-0 flex flex-col items-start space-y-2">
                                        <div class="text-xl font-semibold">{{ $cbt->nama_peserta }}</div>
                                        <div>Kelas {{ $cbt->kelompok }}</div>
                                        <div class="flex flex-col items-start pt-4 text-sm space-y-2">
                                            <div>Akses Aplikasi: https://cbt.nfbsnet.edu (Lokal Server)</div>
                                            <div>Username: {{ $cbt->no_peserta }}</div>
                                            <div>Password: {{ $cbt->kode_akses }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <a href="{{ route('user.pas.print', auth()->id()) }}"
                            class="mt-2 block text-sm text-blue-500 font-medium hover:underline">
                            Lihat selengkapnya
                        </a> --}}
                    </div>
                    @else
                    <div class="rounded-md bg-yellow-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">
                                    Akses terkunci
                                </h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>
                                        Mohon untuk menyelesaikan administrasi agar mendapatkan akses!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
</div>
