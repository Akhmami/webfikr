<div>
    <form wire:submit.prevent="save">
        <div class="px-4 py-5 sm:p-6 md:grid md:grid-cols-3 md:gap-6">
            @if ($errors->any())
            @php
            dump($errors->any())
            @endphp
            @endif
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Tambah Slideshow</h3>
                <p class="mt-1 mb-4 text-sm text-gray-500">
                    untuk mempercepat load time website sangat disarankan untuk mengurangi ukuran gambar,
                    manfaatkan
                    <a href="https://tinyjpg.com/" class="text-blue-600 font-semibold" target="_blank">tinyjpg</a> untuk
                    mereduce namun kualitas
                    gambar tetap bagus.
                </p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="space-y-6">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Slide image
                        </label>
                        <x-file-attachment wire:model="image" :file="$image" />
                    </div>
                    <x-input label="Judul" name="title" placeholder="Opsional" livewire />
                    <x-input label="Url" name="url" placeholder="Opsional" livewire />
                </div>
            </div>
        </div>
        <div class="flex justify-end px-4 py-3 rounded-b-xl bg-gray-50 sm:px-6">
            <button type="button"
                class="bg-white py-2 px-5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </button>
            <button type="submit"
                class="ml-3 inline-flex justify-center py-2 px-6 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Save
            </button>
        </div>
    </form>

    @once
    @push('script')
    <script src="{{ mix('js/tinymce/tinymce.min.js') }}"></script>
    @endpush
    @endonce
</div>
