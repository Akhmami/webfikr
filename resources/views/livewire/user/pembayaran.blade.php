<div>
    <section aria-labelledby="profile-overview-title">
        <div class="rounded-lg bg-white overflow-hidden shadow">
            <h2 class="sr-only" id="profile-overview-title">Pembayaran Overview</h2>
            <div class="bg-white p-6">
                <div class="flex flex-col">
                    @foreach ($payments as $payment)
                    <div class="text-center">
                        <h2 class="text-lg font-semibold">Selesaikan Pembayaran dalam</h2>
                        <span class="sr-only"
                            id="date">{{ date('M j, Y H:i:s', strtotime($payment->datetime_expired)) }}</span>
                        <div class="py-2 text-xl font-bold text-red-500" id="demo"></div>
                        <span class="text-sm text-gray-500">Batas Akhir Pembayaran</span>
                        <h2 class="text-lg font-semibold">{{ $payment->date_expired }}</h2>
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
                                        Nomor Virtual Account
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
                                        Total Pembayaran
                                    </p>
                                    <p class="text-lg font-bold truncate">
                                        {{ rupiah($payment->trx_amount) }}
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

                    <div class="w-2/3 mx-auto mt-4">
                        <h2>Cara Pembayaran</h2>
                        <ol class="text-sm">
                            <li>1. Buka...</li>
                        </ol>
                    </div>
                    @endforeach
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
            document.getElementById("demo").innerHTML = "EXPIRED";
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
