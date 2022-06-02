<x-user-layout>
    <main class="-mt-24 pb-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="sr-only">Pembayaran</h1>
            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">
                <!-- Left column -->
                <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                    <!-- Welcome panel -->
                    {{--
                    <livewire:user.upload-berkas /> --}}
                    <section aria-labelledby="profile-overview-title">
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <h2 class="sr-only" id="profile-overview-title">Berkas Overview</h2>
                            <div class="bg-white p-6">
                                <form action="{{ route('user.berkas.store') }}" method="POST"
                                    enctype="multipart/form-data" class="space-y-8 divide-y divide-gray-200">
                                    @csrf
                                    <div class="space-y-8 divide-y divide-gray-200">
                                        <div>
                                            <div>
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    Kelengkapan Berkas
                                                </h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Mohon untuk melengkapi berkas berikut
                                                </p>
                                            </div>

                                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                                <div class="sm:col-span-4">
                                                    <label for="nama" class="block text-sm font-medium text-gray-700">
                                                        Jenis Berkas
                                                    </label>
                                                    <div class="mt-1">
                                                        <select id="country" name="nama"
                                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            <option value="">Pilih</option>
                                                            <option value="Akta">Akta Kelahiran</option>
                                                            <option value="KK">Kartu Keluarga</option>
                                                            <option value="Rapor">Identitas Rapor</option>
                                                            <option value="NISN">Validasi NISN</option>
                                                            <option value="Ijazah">Ijazah</option>
                                                        </select>
                                                        @error('nama')
                                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-6">
                                                    <label for="cover-photo"
                                                        class="block text-sm font-medium text-gray-700">
                                                        Masukan Berkas
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="file" name="file"
                                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                        @error('file')
                                                        <small class="text-sm text-red-500">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
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
                                </form>
                            </div>
                        </div>
                    </section>

                    <section aria-labelledby="quick-links-title">
                        <div
                            class="rounded-lg bg-gray-50 overflow-hidden shadow divide-y divide-gray-200 sm:divide-y-0">
                            <h2 class="sr-only" id="quick-links-title">Quick links</h2>

                            <div class="col-span-2 bg-white px-6 py-4 rounded-tl-lg rounded-tr-lg">
                                File yang telah diupload
                            </div>

                            <div class="flex px-6 py-4 space-x-4">
                                @foreach ($uploads as $item)
                                <a href="{{ route('user.berkas.show', $item->file) }}"
                                    class="text-blue-600 hover:underline">{{
                                    $item->nama }}</a>
                                @endforeach
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
