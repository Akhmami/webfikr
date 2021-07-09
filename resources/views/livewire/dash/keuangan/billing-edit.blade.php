<div>
    <x-modal action="update({{$billing_id}})">
        <x-slot name="title">
            Buat billing baru
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-4">
                @php
                $type = [
                'SPP' => 'SPP',
                'DKT' => 'DKT',
                'PSB' => 'PSB',
                'DUPSB' => 'Daftar Ulang PSB',
                'MUTASI' => 'Mutasi',
                'DUMUTASI' => 'Daftar Ulang Mutasi',
                'LAINNYA' => 'Lainnya'
                ];
                $btype = [
                'o' => 'Open Payment',
                'i' => 'Partial Payment',
                'c' => 'Close Payment'
                ];
                @endphp
                <x-select label="Jenis pembayaran" name="billing_type" :list="$btype" disabled livewire />
                <x-select label="Untuk" name="type" :list="$type" disabled livewire />
                <x-input label="Tanggal kadaluarsa" name="datetime_expired" livewire />

                @foreach ($billing_details as $key => $val)
                <div class="flex items-center space-x-2">
                    <x-input label="Keterangan" name="nama.{{$key}}" livewire />
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nominal</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" wire:model="nominal.{{$key}}"
                                class="block w-full focus:outline-none sm:text-sm rounded-md @error('nominal.{{$key}}')pr-10 border-red-300 border-2 text-red-900 focus:ring-red-500 focus:border-red-500 @enderror">
                            @error ('nominal.{{$key}}')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <!-- Heroicon name: solid/exclamation-circle -->
                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            @enderror
                        </div>
                        @error ('nominal.{{$key}}')
                        <p class="mt-2 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="pt-6">
                        @if ($loop->index === 0)
                        <button type="button" wire:click.prevent="add({{$i}})"
                            class="inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-0.5 mr-2 h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                    clip-rule="evenodd" />
                            </svg>
                            Add More
                        </button>
                        @else
                        <button type="button" wire:click.prevent="remove({{$key}})"
                            class="inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-0.5 mr-2 h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                            Remove
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah tagihan</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" wire:model="amount"
                            class="block w-full focus:outline-none sm:text-sm rounded-md @error('amount')pr-10 border-red-300 border-2 text-red-900 focus:ring-red-500 focus:border-red-500 @enderror"
                            readonly>
                        @error ('amount')
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <!-- Heroicon name: solid/exclamation-circle -->
                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        @enderror
                    </div>
                    @error ('amount')
                    <p class="mt-2 text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
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
