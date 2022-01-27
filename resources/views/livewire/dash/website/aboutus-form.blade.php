<div>
    <form wire:submit.prevent="save">
        <div class="px-4 py-5 sm:p-6 md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Tentang Kami</h3>
                <p class="mt-1 mb-4 text-sm text-gray-500">
                    URL Video Embed bisa didapatkan dari channel Youtube terkait,
                    sedangkan URL baca selengkapnya bisa diperoleh pada artikel website yang membahas deskripsi secara
                    detail.
                </p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="space-y-6">
                    <x-input label="URL Video Embed" name="url_embed" livewire />
                    <x-input label="Url baca selengkapnya" name="url_read_more" livewire />
                    <x-tinymce wire:model="body" placeholder="Type anything you want..." />
                    @error('body')
                    <p class="mt-2 text-xs font-semibold text-red-600" id="email-error">{{ $message }}</p>
                    @enderror
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
