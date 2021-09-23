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
                    @if($errors->any())
                    @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach
                    @endif
                    <form wire:submit.prevent="store" class="mt-6 space-y-4">
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
                        <div class="text-right pt-4">
                            <button type="submit"
                                class="whitespace-nowrap inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-origin-border px-6 py-2 border border-transparent rounded-lg shadow-sm text-base font-medium text-white hover:from-purple-700 hover:to-indigo-700">
                                DAFTAR SEKARANG
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
