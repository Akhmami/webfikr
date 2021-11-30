<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAS Card</title>
    <link rel="stylesheet" href="{{ asset('css/pas.css') }}">
    <style>
        @page {
            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
        }

        @media print {

            html,
            body {
                height: 100%;
                margin: 0 !important;
                padding: 0 !important;
                overflow: hidden;
            }

            #button-print {
                visibility: hidden;
            }
        }
    </style>
</head>

<body>
    <div class="max-w-2xl mx-auto py-4 space-y-2">
        {{-- Heading --}}
        <div class="flex items-center justify-between border-b-4 border-gray-700 pb-2">
            <div>
                <img class="w-20 h-20" src="{{ asset('images/logo.png') }}" alt="Logo NF">
            </div>
            <div class="font-semibold text-lg text-center">
                <p>
                    YAYASAN PESANTREN IBNU SALAM NURUL FIKRI<br>
                    {{ $user->userDetail->jenjang }} ISLAM NURUL FIKRI BOARDING SCHOOL SERANG<br>
                    TAHUN PELAJARAN 2021/2022
                </p>
            </div>
            <div>
                <img class="w-20 h-20" src="{{ asset('images/tut-wuri.png') }}" alt="Logo tutwuri">
            </div>
        </div>
        {{-- User ID --}}
        <div class="pt-4 flex">
            <div class="w-full space-y-4">
                <div class="font-medium text-center">
                    <p>
                        KARTU PESERTA<br>
                        PENILAIAN AKHIR SEMESTER (PAS) GANJIL
                    </p>
                </div>
                <div>
                    @if (!empty($cbt->data))
                    <table class="table-auto">
                        <tr>
                            <td class="pl-4">Nama</td>
                            <td>: {{ $user->name }}</td>
                            <td class="pl-8">No. Peserta </td>
                            <td class="pr-4">: {{ $cbt->data->username }}</td>
                        </tr>
                        <tr>
                            <td class="pl-4">Kelas</td>
                            <td>: {{ $cbt->data->kelas }}</td>
                            <td class="pl-8">Ruang</td>
                            <td class="pr-4"></td>
                        </tr>
                    </table>
                    @else
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-700">
                                    {{ $cbt->message }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="w-1/5 text-gray-400 text-center">
                <img src="{{ asset('images/photos/' . strtoupper($user->name) . '.JPG') }}" alt="photo">
            </div>
        </div>
        <div class="pt-4">
            @if ($user->userDetail->jenjang === 'SMP')
            <table class="text-sm w-full border-collapse border">
                <tr>
                    <th class="border">No.</th>
                    <th class="border w-2/12">Hari/Tgl</th>
                    <th class="border">Waktu</th>
                    <th class="border">Mata Pelajaran</th>
                    <th class="w-2/12 border">Paraf</th>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center p-1">1</td>
                    <td rowspan="2" class="border text-center p-1">Senin, 6 Desember 2021</td>
                    <td class="border text-center p-1">07.30 – 08.30</td>
                    <td class="border text-center p-1">PAI</td>
                    <td class="p-1">1.</td>
                </tr>
                <tr>
                    <td class="border text-center p-1">09.00 – 10.30</td>
                    <td class="border text-center p-1">BAHASA INDONESIA</td>
                    <td class="p-1">2.</td>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center p-1">2</td>
                    <td rowspan="2" class="border text-center p-1">Selasa, 7 Desember 2021</td>
                    <td class="border text-center p-1">07.30 – 08.30</td>
                    <td class="border text-center p-1">MATEMATIKA</td>
                    <td class="p-1">3.</td>
                </tr>
                <tr>
                    <td class="border text-center p-1">09.00 – 10.30</td>
                    <td class="border text-center p-1">SETORAN HADIST WILAYAH THALIB</td>
                    <td class="p-1">4.</td>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center p-1">3</td>
                    <td rowspan="2" class="border text-center p-1">Rabu, 8 Desember 2021</td>
                    <td class="border text-center p-1">07.30 – 08.30</td>
                    <td class="border text-center p-1">IPS</td>
                    <td class="p-1">5.</td>
                </tr>
                <tr>
                    <td class="border text-center p-1">09.00 – 10.30</td>
                    <td class="border text-center p-1">BAHASA ARAB</td>
                    <td class="p-1">6.</td>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center p-1">4</td>
                    <td rowspan="2" class="border text-center p-1">Kamis, 9 Desember 2021</td>
                    <td class="border text-center p-1">07.30 – 08.30</td>
                    <td class="border text-center p-1">IPA</td>
                    <td class="p-1">7.</td>
                </tr>
                <tr>
                    <td class="border text-center p-1">09.00 – 10.30</td>
                    <td class="border text-center p-1">SETORAN HADIST WILAYAH THALIBAH</td>
                    <td class="p-1">8.</td>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center p-1">5</td>
                    <td rowspan="2" class="border text-center p-1">Jumat, 10 Desember 2021</td>
                    <td class="border text-center p-1">07.30 – 08.30</td>
                    <td class="border text-center p-1">BAHASA INGGRIS</td>
                    <td class="p-1">9.</td>
                </tr>
                <tr>
                    <td class="border text-center p-1">09.00 – 10.30</td>
                    <td class="border text-center p-1">UJIAN SUSULAN</td>
                    <td class="p-1">10.</td>
                </tr>
            </table>
            @else
            <table class="text-sm w-full border-collapse border">
                <tr>
                    <th rowspan="2" class="border">No.</th>
                    <th rowspan="2" class="border w-2/12">Hari/Tgl</th>
                    <th rowspan="2" class="border">Waktu</th>
                    <th colspan="2" class="border">Mata Pelajaran</th>
                    <th rowspan="2" class="w-2/12 border">Paraf</th>
                </tr>
                <tr>
                    <th class="border text-center">IPA</th>
                    <th class="border text-center">IPS</th>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center">1</td>
                    <td rowspan="2" class="border w-2/12 text-center">Senin,
                        6 Desember 2021</td>
                    <td class="border text-center">07.30 – 09.00</td>
                    <td class="border text-center">MATEMATIKA WAJIB</td>
                    <td class="border text-center">MATEMATIKA WAJIB</td>
                    <td class="p-1">1.</td>
                </tr>
                <tr>
                    <td class="border text-center">09.30 – 11.00</td>
                    <td class="border text-center">SEJARAH WAJIB</td>
                    <td class="border text-center">SEJARAH WAJIB</td>
                    <td class="p-1">2.</td>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center">2</td>
                    <td rowspan="2" class="border w-2/12 text-center">Selasa,
                        7 Desember 2021</td>
                    <td class="border text-center">07.30 – 09.00</td>
                    <td class="border text-center">KIMIA</td>
                    <td class="border text-center">SOSIOLOGI</td>
                    <td class="p-1">3.</td>
                </tr>
                <tr>
                    <td class="border text-center">09.30 – 11.00</td>
                    <td class="border text-center">BAHASA ARAB</td>
                    <td class="border text-center">BAHASA ARAB</td>
                    <td class="p-1">4.</td>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center">3</td>
                    <td rowspan="2" class="border w-2/12 text-center">Rabu,
                        8 Desember 2021</td>
                    <td class="border text-center">07.30 – 09.00</td>
                    <td class="border text-center">FISIKA</td>
                    <td class="border text-center">EKONOMI</td>
                    <td class="p-1">5.</td>
                </tr>
                <tr>
                    <td class="border text-center">09.30 – 11.00</td>
                    <td class="border text-center">BAHASA INDONESIA</td>
                    <td class="border text-center">BAHASA INDONESIA</td>
                    <td class="p-1">6.</td>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center">4</td>
                    <td rowspan="2" class="border w-2/12 text-center">Kamis,
                        9 Desember 2021</td>
                    <td class="border text-center">07.30 – 09.00</td>
                    <td class="border text-center">BIOLOGI</td>
                    <td class="border text-center">GEOGRAFI</td>
                    <td class="p-1">7.</td>
                </tr>
                <tr>
                    <td class="border text-center">09.30 – 11.00</td>
                    <td class="border text-center">BAHASA INGGRIS</td>
                    <td class="border text-center">BAHASA INGGRIS</td>
                    <td class="p-1">8.</td>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center">5</td>
                    <td rowspan="2" class="border w-2/12 text-center">Jum'at,
                        10 Desember 2021</td>
                    <td class="border text-center">07.30 – 09.00</td>
                    <td class="border text-center">MATEMATIKA PEMINATAN</td>
                    <td class="border text-center">SEJARAH PEMINATAN</td>
                    <td class="p-1">9.</td>
                </tr>
                <tr>
                    <td class="border text-center">09.30 – 11.00</td>
                    <td class="border text-center">PENDIDIKAN AGAMA ISLAM</td>
                    <td class="border text-center">PENDIDIKAN AGAMA ISLAM</td>
                    <td class="p-1">10.</td>
                </tr>

                <tr>
                    <td rowspan="2" class="border text-center">6</td>
                    <td rowspan="2" class="border w-2/12 text-center">Sabtu,
                        11 Desember 2021</td>
                    <td colspan="4" rowspan="2" class="border text-center">PAS SUSULAN</td>
                </tr>
            </table>
            @endif
            <div class="flex justify-between items-center pt-4">
                <div class="flex flex-col items-start p-2 text-sm space-y-2 border-2">
                    <div>Akses Aplikasi: https://cbt.nfbsnet.edu</div>
                    <div>Username: {{ $cbt->data->username }}</div>
                    <div>Password: {{ $cbt->data->password }}</div>
                </div>
                <div class="relative space-y-12 pl-6">
                    <div class="pb-4">Kepala Sekolah</div>
                    @if ($user->userDetail->jenjang === 'SMP')
                    <div class="absolute bottom-0 left-0 pb-4">
                        <img class="w-80 h-auto z-20" src="{{ asset('images/ttd-stempel-smp.png') }}" alt="ttd">
                    </div>
                    <div class="font-bold">Irmawati, S.Pd.</div>
                    @else
                    <div class="absolute bottom-0 left-0 pb-4">
                        <img class="w-80 h-auto z-20" src="{{ asset('images/ttd-stempel-sma.png') }}" alt="ttd">
                    </div>
                    <div class="font-bold">Hari Untung Maulana, M.Pd.</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="pt-14">
            <button id="button-print" type="button" onclick="window.print()"
                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print or Download
            </button>
        </div>
    </div>

    <script type="text/javascript">
        // <![CDATA[
            document.body.onload = function() {
                document.body.offsetHeight;
                window.print()
            };
            // ]]>
    </script>
</body>

</html>
