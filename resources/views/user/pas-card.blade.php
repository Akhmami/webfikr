<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAS Card</title>
    <link rel="stylesheet" href="{{ asset('css/pas.css') }}">
    <style>
        @media print {
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
            <div class="w-1/5 bg-gray-200 text-gray-400 text-center">Photo</div>
        </div>
        <div class="pt-8">
            @if ($user->userDetail->jenjang === 'SMP')
            <table class="text-sm w-full border-collapse border">
                <tr>
                    <th class="border">No.</th>
                    <th class="border w-2/12">Hari/Tgl</th>
                    <th class="border">Waktu</th>
                    <th class="border">Pelajaran</th>
                    <th class="w-2/12 border">Paraf</th>
                </tr>
                <tr>
                    <td class="border text-center p-1">1</td>
                    <td class="border text-center p-1">Senin, 6 Desember 2021</td>
                    <td class="border text-center p-1">
                        <div>07.30 – 08.30</div>
                        <div>09.00 – 10.30</div>
                    </td>
                    <td class="border text-center p-1">
                        <div>PAI</div>
                        <div>BAHASA INDONESIA</div>
                    </td>
                    <td class="border p-1">
                        <div>1.</div>
                        <div>2.</div>
                    </td>
                </tr>
                <tr>
                    <td class="border text-center p-1">2</td>
                    <td class="border text-center p-1">Selasa, 7 Desember 2021</td>
                    <td class="border text-center p-1">
                        <div>07.30 – 08.30</div>
                        <div>09.00 – 10.30</div>
                    </td>
                    <td class="border text-center p-1">
                        <div>MATEMATIKA</div>
                        <div>SETORAN HADIST WILAYAH THALIB</div>
                    </td>
                    <td class="border p-1">
                        <div>3.</div>
                        <div>4.</div>
                    </td>
                </tr>
                <tr>
                    <td class="border text-center p-1">3</td>
                    <td class="border text-center p-1">Rabu, 8 Desember 2021</td>
                    <td class="border text-center p-1">
                        <div>07.30 – 08.30</div>
                        <div>09.00 – 10.30</div>
                    </td>
                    <td class="border text-center p-1">
                        <div>IPS</div>
                        <div>BAHASA ARAB</div>
                    </td>
                    <td class="border p-1">
                        <div>5.</div>
                        <div>6.</div>
                    </td>
                </tr>
                <tr>
                    <td class="border text-center p-1">4</td>
                    <td class="border text-center p-1">Kamis, 9 Desember 2021</td>
                    <td class="border text-center p-1">
                        <div>07.30 – 08.30</div>
                        <div>09.00 – 10.30</div>
                    </td>
                    <td class="border text-center p-1">
                        <div>IPA</div>
                        <div>SETORAN HADIST WILAYAH THALIBAH</div>
                    </td>
                    <td class="border p-1">
                        <div>7.</div>
                        <div>8.</div>
                    </td>
                </tr>
                <tr>
                    <td class="border text-center p-1">5</td>
                    <td class="border text-center p-1">Jumat, 10 Desember 2021</td>
                    <td class="border text-center p-1">
                        <div>07.30 – 08.30</div>
                        <div>09.00 – 10.30</div>
                    </td>
                    <td class="border text-center p-1">
                        <div>BAHASA INGGRIS</div>
                        <div>UJIAN SUSULAN</div>
                    </td>
                    <td class="border p-1">
                        <div>9.</div>
                        <div>10.</div>
                    </td>
                </tr>
            </table>
            <div class="flex justify-between items-center pt-4">
                <div class="flex flex-col items-start p-2 text-sm space-y-2 border-2">
                    <div>Akses Aplikasi: https://cbt.nfbsnet.edu</div>
                    <div>Username: {{ $cbt->data->username }}</div>
                    <div>Password: {{ $cbt->data->password }}</div>
                </div>
                <div class="">
                    <div>Kepala Sekolah</div>
                    <br><br>
                    <div class="font-bold">
                        @if ($user->userDetail->jenjang === 'SMP')
                        Irmawati, S.Pd.
                        @else
                        Hari Untung Maulana, M.Pd.
                        @endif
                    </div>
                </div>
            </div>
            @else
            Jadwal Tersesia disekolah
            @endif
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
</body>

</html>
