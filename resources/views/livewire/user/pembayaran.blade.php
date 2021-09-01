<div>
    <section aria-labelledby="profile-overview-title">
        <div class="rounded-lg bg-white overflow-hidden shadow">
            <h2 class="sr-only" id="profile-overview-title">Pembayaran Overview</h2>
            <div class="bg-white p-6">
                <div class="flex flex-col">
                    @if (!empty($payment))
                    <div class="text-center">
                        <h2 class="text-lg font-semibold">Selesaikan Pembayaran dalam</h2>
                        <span class="sr-only"
                            id="date">{{ date('M j, Y H:i:s', strtotime($payment->datetime_expired)) }}</span>
                        <div class="py-2 text-xl font-bold text-red-500" id="demo"></div>
                        <span class="text-sm text-gray-500">Batas Akhir Pembayaran</span>
                        <h2 class="text-lg font-semibold mb-4">{{ $payment->date_expired }}</h2>

                        <a href="#" wire:click.prevent="batal" class="text-indigo-600 text-sm hover:underline">Batalkan
                            Pembayaran</a>
                    </div>

                    <div class="w-2/3 mx-auto border rounded-md mt-8">
                        <div class="flex border-b py-4 justify-between">
                            <div class="pl-4">BSI Virtual Account</div>
                            <div class="pr-4">
                                <img class="w-14 h-auto" src="{{ asset('images/bsi.png') }}" alt="BSI">
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-500 truncate">
                                        Kode Bayar
                                    </p>
                                    <p class="text-lg font-bold truncate">
                                        {{ $payment->virtual_account }}
                                    </p>
                                </div>
                                <div>
                                    <button type="button" onclick="copyToClipboard({{$payment->virtual_account}})"
                                        class="inline-flex space-x-1 text-sm leading-5 font-medium text-indigo-600
                                                                                    hover:underline">
                                        Salin <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-500 truncate">
                                        Nomor Virtual Account
                                    </p>
                                    <p class="text-lg font-bold truncate">
                                        {{ $payment->full_virtual_account }}
                                    </p>
                                </div>
                                <div>
                                    <button type="button" onclick="copyToClipboard({{$payment->full_virtual_account}})"
                                        class="inline-flex space-x-1 text-sm leading-5 font-medium text-indigo-600
                                                            hover:underline">
                                        Salin <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-500 truncate">
                                        Biaya Admin Bank BSI
                                    </p>
                                    <p class="text-lg font-bold truncate">
                                        Rp 2.000
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-500 truncate">
                                        Total Pembayaran
                                    </p>
                                    <p class="text-lg font-bold truncate">
                                        {{ rupiah(($payment->trx_amount + 2000)) }}
                                    </p>
                                </div>
                                <div>
                                    <a href="#" class="text-sm leading-5 font-medium text-indigo-600 hover:underline">
                                        Lihat Rincian
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="prose w-2/3 mx-auto mt-6">
                        <h4>Cara Pembayaran</h4>
                        <ul class="text-sm">
                            <li class="font-semibold">Menggunakan Metode Transfer BSI Mobile Banking</li>
                            <ol class="pl-6 pb-4">
                                <li>Akses BSI Mobile Banking dari handphone kemudian pilih "Tansfer".</li>
                                <li>Pilih "Transfer antar Rekening BSI"</li>
                                <li>Masukkan nomor Virtual Account Anda
                                    <strong>{{ $payment->full_virtual_account }}</strong>
                                    pada input "Masukan no rekening tujuan".</li>
                                <li>Masukan nominal <strong>{{ rupiah($payment->trx_amount, false) }}</strong></li>
                                <li>Klik "SELANJUTNYA" dan selesaikan pembayaran</li>
                            </ol>

                            <li class="font-semibold">Menggunakan Pembayaran Akademik BSI Mobile Banking</li>
                            <ol class="pl-6 pb-4">
                                <li>Akses BSI Mobile Banking dari handphone kemudian pilih "Bayar".</li>
                                <li>Pilih "Akademik"</li>
                                <li>Dibagian "Nama Akademik" cari <strong>9194 - NFBS SERANG</strong></li>
                                <li>Dibagian "Masukan ID Pelanggan/Kode Bayar" masukan
                                    <strong>{{ $payment->virtual_account }}</strong></li>
                                <li>Klik "SELANJUTNYA" dan selesaikan pembayaran</li>
                            </ol>

                            <li class="font-semibold">Menggunakan Metode Transfer Dari Bank Lain</li>
                            <ol class="pl-6 pb-4">
                                <li>Pilih menu "Transfer antar bank" atau "Transfer online antarbank".</li>
                                <li>Masukkan kode bank BNI (451) atau pilih bank yang dituju yaitu BSI.</li>
                                <li>Masukkan nomor Virtual Account Anda
                                    <strong>{{ $payment->full_virtual_account }}</strong>
                                    pada rekening tujuan.</li>
                                <li>Masukan nominal transfer <strong>{{ rupiah($payment->trx_amount, false) }}</strong>
                                </li>
                                <li>Konfirmasi rincian Anda akan tampil di layar, cek dan apabila sudah sesuai silahkan
                                    lanjutkan transaksi sampai dengan
                                    selesai.</li>
                            </ol>
                        </ul>
                    </div>
                    @else
                    <!-- Tidak ada pembayaran -->
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" width="44"
                            height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9ca3af" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <circle cx="12" cy="12" r="9" />
                            <line x1="9" y1="10" x2="9.01" y2="10" />
                            <line x1="15" y1="10" x2="15.01" y2="10" />
                            <line x1="9" y1="15" x2="15" y2="15" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pembayaran</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Pastikan kamu tidak memiliki tagihan, lihat rincian tagihan.
                        </p>
                        <div class="mt-6">
                            <button type="button"
                                onclick="Livewire.emit('openModal', 'user.rincian-tagihan', {{ json_encode(['user' => auth()->user()->id ]) }})"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                                </svg>
                                Rincian Tagihan
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @push('script')
    <script>
        // Set the date we're counting down to
        var date = document.getElementById("date").textContent;
        var countDownDate = new Date(date).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

          // Get today's date and time
          var now = new Date().getTime();

          // Find the distance between now and the count down date
          var distance = countDownDate - now;

          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = ('0' + Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).slice(-2);
          var minutes = ('0' + Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).slice(-2);
          var seconds = ('0' + Math.floor((distance % (1000 * 60)) / 1000)).slice(-2);

          // Display the result in the element with id="demo"
          document.getElementById("demo").innerHTML = (days > 0 ? days + " Hari " : '') + hours + ":" + minutes + ":" + seconds;

          // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "DIBATALKAN";
          }
        }, 1000);

        function copyToClipboard(value) {
            var tempInput = document.createElement("input");
            tempInput.value = value;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
        }
    </script>
    @endpush
</div>
