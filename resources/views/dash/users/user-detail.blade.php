<x-dash-layout>
    <x-slot name="breadtitle">
        Rincian Pengguna
    </x-slot>

    <main class="py-10">
        <!-- Page header -->
        <div
            class="max-w-3xl mx-auto px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
            <div class="flex items-center space-x-5">
                <div class="flex-shrink-0">
                    <div class="relative">
                        <img class="h-16 w-16 rounded-full" src="{{ asset('images/user.png') }}" alt="" />
                        <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-sm font-medium text-gray-500">Username <a href=""
                            class="text-gray-900">{{ $user->username }}</a> terdaftar
                        pada <span>{{ tanggal(date('Y-m-d', strtotime($user->created_at))) }}</span></p>
                </div>
            </div>
            <div
                class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
                <a href="{{ route('dash.users.user-page', $user->id) }}"
                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">Switch
                    Ke Halaman User</a>
            </div>
        </div>

        <div
            class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:px-8 lg:grid-flow-col-dense lg:grid-cols-3">
            <div class="space-y-6 lg:col-start-1 lg:col-span-2">
                <!-- Description list-->
                <section aria-labelledby="applicant-information-title">
                    <div class="bg-white shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 id="applicant-information-title" class="text-lg leading-6 font-medium text-gray-900">
                                Rincian Informasi Pengguna</h2>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Informasi pribadi, tagihan, riwayat
                                pembayaran dan lainnya.</p>
                        </div>

                        <div x-data="{ tab: '#personal' }" class="border-t border-gray-200 pb-5">
                            <div class="pb-5">
                                <div class="sm:hidden">
                                    <label for="tabs" class="sr-only">Select a tab</label>
                                    <select id="tabs" name="tabs"
                                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                        <option selected>Personal</option>

                                        <option></option>
                                    </select>
                                </div>
                                <div class="hidden sm:block">
                                    <div class="border-b border-gray-200 px-4 sm:px-6">
                                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                            <a href="#" x-on:click.prevent="tab='#personal'"
                                                :class="{ 'border-indigo-500 text-indigo-600' : tab === '#personal' }"
                                                class="border-transparent text-gray-500 hover:text-indigo-600 hover:border-indigo-500 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                                                aria-current="page">
                                                Personal
                                            </a>

                                            <a href="#" x-on:click.prevent="tab='#ayah'"
                                                :class="{ 'border-indigo-500 text-indigo-600' : tab === '#ayah' }"
                                                class="border-transparent text-gray-500 hover:text-indigo-600 hover:border-indigo-500 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                                Ayahanda
                                            </a>

                                            <a href="#" x-on:click.prevent="tab='#ibu'"
                                                :class="{ 'border-indigo-500 text-indigo-600' : tab === '#ibu' }"
                                                class="border-transparent text-gray-500 hover:text-indigo-600 hover:border-indigo-500 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                                Ibunda
                                            </a>

                                            <a href="#" x-on:click.prevent="tab='#spp'"
                                                :class="{ 'border-indigo-500 text-indigo-600' : tab === '#spp' }"
                                                class="border-transparent text-gray-500 hover:text-indigo-600 hover:border-indigo-500 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                                SPP
                                            </a>

                                            <a href="#" x-on:click.prevent="tab='#riwayat-pembayaran'"
                                                :class="{ 'border-indigo-500 text-indigo-600' : tab === '#riwayat-pembayaran' }"
                                                class="border-transparent text-gray-500 hover:text-indigo-600 hover:border-indigo-500 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                                Riwayat Pembayaran
                                            </a>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                            <dl x-show="tab == '#personal'" x-cloak
                                class="px-4 sm:px-6 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">No. pendaftaran</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->no_pendaftaran }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Email address</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <div class="flex space-x-2 items-center">
                                            <div>{{ $user->email }}</div>
                                            <a href="#" class="p-1 rounded-md hover:bg-yellow-500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 text-gray-500 hover:text-gray-900"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <div class="flex space-x-2 items-center">
                                            <div>{{ $user->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                            <a href="#" class="p-1 rounded-md hover:bg-yellow-500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 text-gray-500 hover:text-gray-900"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <x-badge color="green" text="santri" />
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Tempat, tanggal lahir</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->tempat_tanggal_lahir }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        @foreach ($user->mobilePhones as $phone)
                                        <div class="flex space-x-2 items-center">
                                            <div><strong>{{ $phone->full_number }}</strong> ({{ $phone->name }})</div>
                                            <a href="#" class="p-1 rounded-md hover:bg-yellow-500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 text-gray-500 hover:text-gray-900"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                        </div>
                                        @endforeach
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">NIK</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->nik }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">NIS // NISN</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <div class="flex space-x-2 items-center">
                                            <div>{{ $user->userDetail->nis ?? '-' }} // {{ $user->userDetail->nisn }}
                                            </div>
                                            <a href="#" class="p-1 rounded-md hover:bg-yellow-500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 text-gray-500 hover:text-gray-900"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Jenjang</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->jenjang }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Angkatan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <div class="flex space-x-4">
                                            <div>{{ $user->userDetail->angkatan }}</div>
                                            <div>
                                                <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                                            </div>
                                        </div>
                                    </dd>
                                </div>
                                <!--
                                Untuk PSB
                                Jurusan pilihan
                                Jenis Pendaftaran
                                ISI DISINI!

                                -->
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Jurusan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->jurusan }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">NPSN // Asal sekolah</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $user->userDetail->npsn }} // {{ $user->userDetail->asal_sekolah }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Alamat asal sekolah</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $user->userDetail->alamat_asal_sekolah }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">HP asal sekolah</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->hp_asal_sekolah }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Negara</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $user->userDetail->neagara }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Anak ke</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->anak_ke }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Jumlah saudara</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $user->userDetail->jml_saudara }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Attachments</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <!-- Heroicon name: solid/paper-clip -->
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="ml-2 flex-1 w-0 truncate">
                                                        resume_front_end_developer.pdf
                                                    </span>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                                        Download </a>
                                                </div>
                                            </li>

                                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <!-- Heroicon name: solid/paper-clip -->
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="ml-2 flex-1 w-0 truncate">
                                                        coverletter_front_end_developer.pdf </span>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                                        Download </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </dd>
                                </div>
                            </dl>

                            <dl x-show="tab == '#ayah'" x-cloak
                                class="px-4 sm:px-6 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Nama ayah</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->nama_ayah }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Tanggal lahir</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->tahun_lahir_ayah }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Pendidikan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->pendidikan_ayah }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Pekerjaan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->pekerjaan_ayah }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Tempat kerja</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->tempat_kerja_ayah }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Penghasilan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->penghasilan_ayah }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Pendidikan agama</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->pendidikan_agama_ayah }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Bacaan Quran</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->baca_quran_ayah }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Haji dan Umroh</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->haji_umroh_ayah }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Organisasi</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $user->userDetail->organisasi_islam_ayah }}
                                    </dd>
                                </div>
                            </dl>

                            <dl x-show="tab == '#ibu'" x-cloak
                                class="px-4 sm:px-6 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Nama ibu</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->nama_ibu }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Tanggal lahir</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->tahun_lahir_ibu }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Pendidikan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->pendidikan_ibu }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Pekerjaan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->pekerjaan_ibu }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Tempat kerja</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->tempat_kerja_ibu }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Penghasilan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->penghasilan_ibu }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Pendidikan agama</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->pendidikan_agama_ibu }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Bacaan Quran</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->baca_quran_ibu }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Haji dan Umroh</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->haji_umroh_ibu }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Organisasi</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $user->userDetail->organisasi_islam_ibu }}
                                    </dd>
                                </div>
                            </dl>

                            <dl x-show="tab == '#spp'" x-cloak
                                class="px-4 sm:px-6 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <livewire:dash.users.spp-user :user="$user" />
                                </div>
                            </dl>

                            <dl x-show="tab == '#riwayat-pembayaran'" x-cloak
                                class="px-4 sm:px-6 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <livewire:dash.users.payment-history-table :user="$user->id" />
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <!-- new section here -->
            </div>

            <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1">
                <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                    <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Aktifitas Pengguna</h2>

                    <!-- Activity Feed -->
                    <div class="mt-6 flow-root">
                        <ul class="-mb-8">
                            @foreach ($user->activities as $activity)
                            <li>
                                <div class="relative pb-8">
                                    @if ($user->activities->count() > 1 && !$loop->last)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                        aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span
                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2h-1.528A6 6 0 004 9.528V4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M8 10a4 4 0 00-3.446 6.032l-1.261 1.26a1 1 0 101.414 1.415l1.261-1.261A4 4 0 108 10zm-2 4a2 2 0 114 0 2 2 0 01-4 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    <a href="#"
                                                        class="hover:text-gray-900">{{ $activity->description }}</a>
                                                </p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time
                                                    datetime="{{ $activity->created_at }}">{{ $activity->created_at->shortRelativeDiffForHumans() }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-6 flex flex-col justify-stretch">
                        <a href="{{ route('dash.users.index') }}#aktifitas-user"
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Lihat
                            lainnya</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-dash-layout>
