<x-user-layout>
    <main class="-mt-24 pb-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="sr-only">SPP</h1>
            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">
                <!-- Left column -->
                <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                    <!-- Welcome panel -->
                    <section aria-labelledby="other-overview-title">
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <h2 class="sr-only" id="profile-overview-title">Ukuran baju</h2>
                            <div class="bg-white p-6">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Ukuran Baju
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Ukuran seragam yang akan dikenakan santri.
                                    </p>
                                </div>
                                <div class="mt-4" x-data="{ show: false }" x-cloak>
                                    <button
                                        class="px-2.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        @click="show = !show">Lihat tabel ukuran</button>
                                    <div x-show="show">
                                        <img src="{{ asset('images/clothing/kemeja_'. auth()->user()->gender .'.png') }}"
                                            alt="Kemeja">
                                        <img src="{{ asset('images/clothing/celana_'. auth()->user()->gender .'.png') }}"
                                            alt="Celana">
                                    </div>
                                </div>
                                <div role="list" class="divide-y divide-gray-200">
                                    @forelse ($baju as $item)
                                    <div class="px-4 py-4 sm:px-0">
                                        <strong>{{ $item->nama }}</strong>
                                        <button type="button"
                                            onclick="Livewire.emit('openModal', 'user.edit-baju', {{ json_encode(['baju' => $item->id ]) }})"
                                            class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Edit
                                        </button>
                                        <p class="text-sm text-gray-600">
                                            Ukuran <strong>{{ $item->ukuran }}</strong><br>
                                            {{ $item->deskripsi }}
                                        </p>
                                    </div>
                                    @empty
                                    <form class="space-y-8" action="{{ route('user.baju.store') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="nama[0]" value="Kemeja">
                                        <input type="hidden" name="nama[1]"
                                            value="{{ auth()->user()->gender == 'L' ? 'Celana' : 'Rok' }}">
                                        <div class="space-y-8 divide-y divide-gray-200">
                                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                                <div class="sm:col-span-4">
                                                    <label for="nama" class="block text-sm font-medium text-gray-700">
                                                        Ukuran Kemeja
                                                    </label>
                                                    <div class="mt-1">
                                                        <select id="country" name="ukuran[0]"
                                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            <option value="">Pilih</option>
                                                            <option value="XS">XS</option>
                                                            <option value="S">S</option>
                                                            <option value="M">M</option>
                                                            <option value="L">L</option>
                                                            <option value="XL">XL</option>
                                                            <option value="XXL">XXL</option>
                                                            <option value="XXXL">XXXL</option>
                                                        </select>
                                                        @error('nama')
                                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-4">
                                                    <label for="keterangan"
                                                        class="block text-sm font-medium text-gray-700">
                                                        Deskripsi Kemeja
                                                    </label>
                                                    <div class="mt-1">
                                                        <textarea name="deskripsi[0]" rows="3"
                                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                                                    </div>
                                                    <p class="mt-2 text-sm text-gray-500">
                                                        Isi deskripsi jika ada informasi lain.
                                                    </p>
                                                </div>

                                                <div class="sm:col-span-4">
                                                    <label for="cover-photo"
                                                        class="block text-sm font-medium text-gray-700">
                                                        Ukuran {{ auth()->user()->gender == 'L' ? 'Celana' : 'Rok' }}
                                                    </label>
                                                    <div class="mt-1">
                                                        <select id="country" name="ukuran[1]"
                                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            <option value="">Pilih</option>
                                                            @for ($i = 24; $i <= 45; $i++) <option value="{{ $i }}">{{
                                                                $i }}
                                                                </option>
                                                                @endfor
                                                        </select>
                                                        @error('nama')
                                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-4">
                                                    <label for="keterangan"
                                                        class="block text-sm font-medium text-gray-700">
                                                        Deskripsi {{ auth()->user()->gender == 'L' ? 'Celana' : 'Rok'
                                                        }}
                                                    </label>
                                                    <div class="mt-1">
                                                        <textarea name="deskripsi[1]" rows="3"
                                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                                                    </div>
                                                    <p class="mt-2 text-sm text-gray-500">
                                                        Isi Deskripsi jika ada informasi lain.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="pt-5">
                                                <div class="flex justify-end">
                                                    <button type="submit"
                                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Upload
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endforelse
                                    </ul>
                                </div>
                            </div>
                    </section>
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4">
                    @include('partials.user.sidebar')
                </div>
            </div>
        </div>
    </main>
</x-user-layout>
