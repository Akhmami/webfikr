<div>
    <x-modal action="update">
        <x-slot name="title">
            Edit Gelombang
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <x-input label="Nama Gelombang" name="nama" livewire />
                <x-datetime-picker label="Tanggal Tes" name="tgl_tes" livewire />
                <x-datetime-picker label="Tanggal Wawancara" name="tgl_wawancara" livewire />
                <x-datetime-picker label="Tanggal Pengumuman" name="tgl_pengumuman" livewire />
                <x-datetime-picker label="Batas Pembayaran DUPSB" name="batas_pembayaran" livewire />
                <x-input label="Biaya Pendaftaran" type="number" name="biaya_pendaftaran" livewire />
                @php
                $list_active = ['Y' => 'active', 'N' => 'inactive'];
                @endphp
                <x-select label="Status" name="is_active" :list="$list_active" livewire />
                <x-datetime-picker label="Masa Berlaku" name="datetime_expired" livewire />
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
