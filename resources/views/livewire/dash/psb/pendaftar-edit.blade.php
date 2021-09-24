<div>
    <x-modal action="update">
        <x-slot name="title">
            Edit Data <strong class="text-gray-400">{{ $name }}</strong>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <x-input label="Nama Lengkap" name="name" livewire />
                <x-input label="NIK (Nomor Induk Kependudukan)" type="number" name="nik" livewire />
                <x-input label="NISN (Nomor Induk Siswa Nasional)" type="number" name="nisn" livewire />
                <x-select label="Jenis Kelamin" name="gender" :list="$list_jk" livewire />
                <div class="grid grid-cols-2 space-x-4">
                    <x-input label="Tempat Lahir" name="birth_place" livewire />
                    <x-date-picker label="Tanggal Lahir" name="birth_date" livewire />
                </div>
                <x-select label="Jenjang Tujuan" name="jenjang" :list="$list_jenjang" livewire />
                @if ($jenjang == 'SMA')
                <x-select label="Jurusan Pilihan" name="jurusan_pilihan" :list="$list_jurusan" livewire />
                @endif
                <x-input label="NPSN Asal Sekolah" type="number" name="npsn" livewire />
                <x-input label="Email" type="email" name="email" livewire />
                <x-select label="Lokasi Tes" name="lokasi_test_id" :list="$lokasi_test" livewire />
                <x-select label="Medical Check" name="medical_check_id" :list="$medical_check" livewire />
            </div>
        </x-slot>

        <x-slot name="buttons">
            <button type="submit"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Update
            </button>
            <button type="button" wire:click="$emit('closeModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2
                focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </x-slot>
    </x-modal>
</div>
