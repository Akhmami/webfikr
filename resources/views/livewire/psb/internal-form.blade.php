<div>
    @once
    @push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush
    @endonce
    <div class="px-4 sm:px-6 bg-white rounded-xl">
        <div class="py-6">
            <!-- Description list with inline editing -->
            <div class="divide-y divide-gray-200">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Formulir Pendaftaran
                        </h3>
                        <p class="max-w-2xl text-sm text-gray-500">
                            Pastikan data yang diisi benar dan sesuai.
                        </p>
                    </div>
                    <div class="inline-flex items-center">
                        <span class="hidden md:block">atau</span>
                        <a href="#"
                            class="ml-4 whitespace-nowrap inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-origin-border px-6 py-2 border border-transparent rounded-lg shadow-sm text-base font-medium text-white hover:from-purple-700 hover:to-indigo-700">
                            Login
                        </a>
                    </div>
                </div>
                <div class="mt-6">

                    @if (empty($user))
                    <form wire:submit.prevent="check" class="mt-6 space-y-4">
                        <x-select label="Cari Berdasarkan:" name="pilihan" :list="$list_pilihan" livewire />

                        @if ($pilihan == 'nik')
                        <x-input label="NIK (Nomor Induk Kependudukan)" type="number" name="nik" livewire />
                        @endif

                        @if ($pilihan == 'ttl')
                        <div class="grid grid-cols-2 space-x-4">
                            <x-input label="Tempat Lahir" name="birth_place" livewire />
                            <x-date-picker label="Tanggal Lahir" name="birth_date" livewire />
                        </div>
                        @endif

                        @if (!$inputVoucher)
                        <div>
                            <a href="#" wire:click.prevent="showVoucher" class="text-blue-600">
                                Punya Voucher Diskon? Klik disini!
                            </a>
                        </div>
                        @else
                        <div class="flex space-x-4">
                            <x-input label="Masukan Voucher" name="voucher" livewire />
                            <button type="button" class="pt-5 text-blue-600 font-bold">
                                Cek Voucher!
                            </button>
                        </div>

                        @if (session()->has('vouchererr'))
                        <strong class="text-red-500 font-semibold text-sm">{{ session('vouchererr') }}</strong>
                        @endif

                        @if (session()->has('vouchersuc'))
                        <strong class="text-green-500 font-semibold text-sm">{{ session('vouchersuc') }}</strong>
                        @endif

                        @endif
                        <div class="text-right pt-4">
                            <button type="submit" wire:loading.remove wire:target="check"
                                class="whitespace-nowrap inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-origin-border px-6 py-2 border border-transparent rounded-lg shadow-sm text-base font-medium text-white hover:from-purple-700 hover:to-indigo-700">
                                SELANJUTNYA
                            </button>
                            <span wire:loading wire:target="check"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium sm:ml-3 sm:w-auto sm:text-sm">Processing...</span>
                        </div>
                    </form>
                    @else
                    <form wire:submit.prevent="store" class="mt-6 space-y-4">
                        <x-input label="Nama Lengkap" name="name" livewire />
                        <x-input label="NIK (Nomor Induk Kependudukan)" type="number" name="nik" livewire />
                        <x-input label="NISN (Nomor Induk Siswa Nasional)" name="nisn" livewire />
                        <x-select label="Jenis Kelamin" name="gender" :list="$list_jk" livewire />
                        <div class="grid grid-cols-2 space-x-4">
                            <x-input label="Tempat Lahir" name="birth_place" livewire />
                            <x-date-picker label="Tanggal Lahir" name="birth_date" livewire />
                        </div>
                        <x-input label="Jenjang Tujuan" name="jenjang" value="SMA Islam Nurul Fikri Serang" disabled />
                        <x-select label="Jurusan Pilihan" name="jurusan_pilihan" :list="$list_jurusan" livewire />
                        <x-input label="Kewarganegaraan" name="negara" livewire />
                        <x-select label="Provinsi" name="provinsi" :list="$prov" livewire />
                        <x-select label="Kabupaten/Kota" name="kabupaten" :list="$kab" livewire />
                        <x-select label="Kecamatan" name="kecamatan" :list="$kec" livewire />
                        <x-select label="Kelurahan" name="kelurahan" :list="$kel" livewire />
                        <x-textarea label="Alamat Jalan" name="alamat" livewire />
                        <x-input label="Nama Ayah" name="nama_ayah" livewire />
                        <x-date-picker label="Tanggal Lahir Ayah" name="tanggal_lahir_ayah" livewire />
                        <x-select label="Pendidikan Ayah" name="pendidikan_ayah" :list="$list_pendidikan" livewire />
                        <x-input label="Pekerjaan Ayah" name="pekerjaan_ayah" livewire />
                        <x-input label="Tempat Kerja Ayah" name="tempat_kerja_ayah" livewire />
                        <x-input label="Nama Ibu" name="nama_ibu" livewire />
                        <x-date-picker label="Tanggal Lahir Ibu" name="tanggal_lahir_ibu" livewire />
                        <x-select label="Pendidikan Ibu" name="pendidikan_ibu" :list="$list_pendidikan" livewire />
                        <x-input label="Pekerjaan Ibu" name="pekerjaan_ibu" livewire />
                        <x-input label="Tempat Kerja Ibu" name="tempat_kerja_ibu" livewire />
                        <x-input label="Email" type="email" name="email" livewire />
                        <x-select label="Lokasi Tes" name="lokasi_test_id" :list="$lokasi_test" livewire />
                        <x-select label="Medical Check" name="medical_check_id" :list="$medical_check" livewire />
                        <div class="text-right pt-4">
                            <button type="submit" wire:loading.remove wire:target="store"
                                class="whitespace-nowrap inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-origin-border px-6 py-2 border border-transparent rounded-lg shadow-sm text-base font-medium text-white hover:from-purple-700 hover:to-indigo-700">
                                DAFTAR SEKARANG
                            </button>
                            <span wire:loading wire:target="store"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium sm:ml-3 sm:w-auto sm:text-sm">Processing...</span>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
