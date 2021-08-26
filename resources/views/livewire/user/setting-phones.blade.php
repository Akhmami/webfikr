<div>
    <!-- Profile section -->
    <div class="py-6 px-4 sm:p-6 lg:pb-8">
        <div>
            <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
                <div class="ml-4 mt-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Mobile Phones
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Daftar nomor telepon, edit nomor telepon.
                    </p>
                </div>
                <div class="ml-4 mt-4 flex-shrink-0">
                    <button type="button" onclick="Livewire.emit('openModal', 'user.setting-create-phone')"
                        class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Tambah nomor
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6 space-y-2">
            @foreach ($phones as $phone)
            <div class="grid grid-cols-12 shadow p-4 rounded {{ $phone->is_first === 'Y' ? 'bg-blue-50' : '' }}">
                <div class="text-sm text-gray-600 col-span-12 sm:text-md sm:text-gray-900 sm:col-span-4">
                    {{ $phone->name }}
                </div>

                <div class="text-md col-span-12 sm:col-span-8">
                    {{ $phone->full_number }} <a href="#"
                        onclick="Livewire.emit('openModal', 'user.setting-edit-phone', {{ json_encode(['phone' => $phone->id ]) }})"
                        class="text-sm text-blue-600 hover:text-blue-900">Edit</a> |
                    @if ($phone->is_first === 'Y')
                    <span class="text-sm text-gray-500">Nomor Utama</span>
                    @else
                    <a href="#" wire:click.prevent="setPrimary({{$phone->id}})"
                        class="text-sm text-blue-600 hover:text-blue-900">Jadikan nomor utama</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
