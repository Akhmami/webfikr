<div>
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
                            Pendaftar dari SMP Islam Nurul Fikri Serang? <a href="{{ route('psb.internal') }}"
                                class="text-red-600 font-semibold animate-pulse">KLIK DISINI!</a>
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
                    <!-- Step dots -->
                    <nav class="flex items-center justify-center mt-6" aria-label="Progress">
                        <p class="text-sm font-medium">Step {{ $currentStep > 3 ? 3 : $currentStep }} of 3</p>
                        <ol role="list" class="ml-8 flex items-center space-x-5">
                            <li>
                                <!-- Personal Step -->
                                <button wire:click.prevent="changeStep(1)"
                                    class="{{ $currentStep >= 1 ? 'bg-indigo-600 hover:bg-indigo-900' : '' }} block w-2.5 h-2.5 rounded-full">
                                    <span class="sr-only">Step 1</span>
                                </button>
                            </li>

                            <li>
                                <!-- Parent Step -->
                                <button wire:click.prevent="changeStep(2)"
                                    class="{{ $currentStep >= 2 ? 'bg-indigo-600 hover:bg-indigo-900' : 'bg-gray-200 hover:bg-gray-400' }} block w-2.5 h-2.5 rounded-full"
                                    {{ $maxStep < 2 ? ' disabled' : '' }}>
                                    <span class="sr-only">Step 2</span>
                                </button>
                            </li>

                            <li>
                                <!-- Contact Step -->
                                <button wire:click.prevent="changeStep(3)"
                                    class="{{ $currentStep >= 3 ? 'bg-indigo-600 hover:bg-indigo-900' : 'bg-gray-200 hover:bg-gray-400' }} block w-2.5 h-2.5 rounded-full"
                                    {{ $maxStep < 3 ? ' disabled' : '' }}>
                                    <span class="sr-only">Step 3</span>
                                </button>
                            </li>
                        </ol>
                    </nav>

                    <form wire:submit.prevent="store" class="mt-6 space-y-4">
                        @if ($currentStep === 1)
                        <x-input label="Nama Lengkap" name="nama_lengkap" livewire />
                        <x-input label="NIK (Nomor Induk Kependudukan)" type="number" name="nik" livewire />
                        <x-input label="NISN (Nomor Induk Siswa Nasional)" type="number" name="nisn" livewire />
                        <x-select label="Jenis Kelamin" name="gender" :list="$list_jk" livewire />
                        <div class="grid grid-cols-2 space-x-4">
                            <x-input label="Tempat Lahir" name="birth_place" livewire />
                            <x-date-picker label="Tanggal Lahir" name="birth_date" livewire />
                        </div>
                        <x-select label="Jenjang Tujuan" name="jenjang" :list="$list_jenjang" livewire />
                        @if ($jenjang === 'SMA')
                        <x-select label="Jurusan Pilihan" name="jurusan_pilihan" :list="$list_jurusan" livewire />
                        @endif
                        <x-input label="NPSN Asal Sekolah" type="number" name="npsn" livewire />
                        @elseif($currentStep === 2)
                        <x-input label="Kewarganegaraan" name="negara" livewire />
                        <x-select label="Provinsi" name="provinsi" :list="$prov" livewire />
                        <x-select label="Kabupaten/Kota" name="kabupaten" :list="$kab" livewire />
                        <x-select label="Kecamatan" name="kecamatan" :list="$kec" livewire />
                        <x-select label="Kelurahan" name="kelurahan" :list="$kel" livewire />
                        <x-textarea label="Alamat Jalan" name="alamat" livewire />
                        <x-input label="Email" type="email" name="email" livewire />
                        <x-select label="Lokasi Tes" name="lokasi_test_id" :list="$lokasi_test" livewire />
                        <x-select label="Medical Check" name="medical_check_id" :list="$medical_check" livewire />
                        @else
                        <x-input label="Nama Ayah" name="nama_ayah" livewire />
                        <x-date-picker label="Tanggal Lahir Ayah" name="tanggal_lahir_ayah" livewire />
                        <x-select label="Pendidikan Ayah" name="pendidikan_ayah" :list="$list_pendidikan" livewire />
                        <x-input label="Pekerjaan Ayah" name="pekerjaan_ayah" livewire />
                        <x-input label="Tempat Kerja Ayah" name="tempat_kerja_ayah" livewire />
                        <div>
                            <label for="number" class="block text-sm font-medium text-gray-700">No WA Ayah</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center w-20">
                                    <label for="country" class="sr-only">Country</label>
                                    <select id="country" wire:model="country_code_ayah"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-3 pr-5 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                                        required>
                                        <option value="62">Pilih</option>
                                        @foreach ($country_code as $key => $value)
                                        <option value="{{ $key }}">{{ $value }} ({{ $key }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" wire:model="no_wa_ayah"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-20 sm:text-sm border-gray-300 rounded-md"
                                    placeholder="877 8077 5548">
                            </div>
                            @error('country_code_ayah')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                            @error('no_wa_ayah')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <x-input label="Nama Ibu" name="nama_ibu" livewire />
                        <x-date-picker label="Tanggal Lahir Ibu" name="tanggal_lahir_ibu" livewire />
                        <x-select label="Pendidikan Ibu" name="pendidikan_ibu" :list="$list_pendidikan" livewire />
                        <x-input label="Pekerjaan Ibu" name="pekerjaan_ibu" livewire />
                        <x-input label="Tempat Kerja Ibu" name="tempat_kerja_ibu" livewire />
                        <div>
                            <label for="number" class="block text-sm font-medium text-gray-700">No WA Ibu</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center w-20">
                                    <label for="country" class="sr-only">Country</label>
                                    <select id="country" wire:model="country_code_ibu"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-3 pr-5 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                                        required>
                                        <option value="62">Pilih</option>
                                        @forelse ($country_code as $key => $value)
                                        <option value="{{ $key }}">{{ $value }} ({{ $key }})
                                        </option>
                                        @empty
                                        Gagal mengambil data, silahkan reload browser
                                        @endforelse
                                    </select>
                                </div>
                                <input type="text" wire:model="no_wa_ibu"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-20 sm:text-sm border-gray-300 rounded-md"
                                    placeholder="877 8077 5548">
                            </div>
                            @error('country_code_ibu')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                            @error('no_wa_ibu')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
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
                                Cek Sekarang!
                            </button>
                        </div>
                        @if (session()->has('vouchererr'))
                        <strong class="text-red-500 font-semibold text-sm">{{ session('vouchererr') }}</strong>
                        @endif
                        @if (session()->has('vouchersuc'))
                        <strong class="text-green-500 font-semibold text-sm">{{ session('vouchersuc') }}</strong>
                        @endif
                        @endif
                        @endif
                        <div class="text-right pt-4">
                            <button type="submit" wire:loading.remove wire:target="store"
                                class="whitespace-nowrap inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-origin-border px-6 py-2 border border-transparent rounded-lg shadow-sm text-base font-medium text-white hover:from-purple-700 hover:to-indigo-700">
                                {{ $currentStep < 3 ? 'SELANJUTNYA' : 'DAFTAR SEKARANG' }}
                            </button>
                            <span wire:loading wire:target="store"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium sm:ml-3 sm:w-auto sm:text-sm">Processing...</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
