<div>
    <form wire:submit.prevent="save">
        <div class="px-4 py-5 sm:p-6 md:grid md:grid-cols-3 md:gap-6">
            @if ($errors->any())
            @php
            dump($errors->any())
            @endphp
            @endif
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Buat Artikel</h3>
                <p class="mt-1 mb-4 text-sm text-gray-500">
                    untuk mempercepat load time website sangat disarankan untuk mengurangi ukuran gambar,
                    manfaatkan
                    <a href="https://tinyjpg.com/" class="text-blue-600 font-semibold" target="_blank">tinyjpg</a> untuk
                    mereduce namun kualitas
                    gambar tetap bagus.
                </p>

                <div class="space-y-6">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Cover image
                        </label>
                        <x-file-attachment wire:model="image" :file="$image" />
                        {{-- <div class="mt-3 flex">
                            <div class="w-16 mr-4 flex-shrink-0 shadow-xs rounded-lg">
                                <div class="relative pb-16 w-full overflow-hidden rounded-lg border border-gray-100">
                                    <img src="{{ $file }}" class="w-full h-full absolute object-cover rounded-lg">
                    </div>
                </div>
                <div>
                    <div class="text-sm font-medium truncate w-40 md:w-auto">{{ $file }}</div>
                    <div class="flex">
                        <div
                            class="relative bg-white py-1 px-2 border border-blue-gray-300 rounded-md shadow-sm flex items-center cursor-pointer hover:bg-blue-gray-50 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-blue-gray-50 focus-within:ring-blue-500">
                            <label for="user-photo"
                                class="relative text-sm font-medium text-blue-gray-900 pointer-events-none">
                                <span>Change</span>
                                <span class="sr-only"> user photo</span>
                            </label>
                            <input id="user-photo" {{ $attributes->wire('model') }} type="file"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="grid grid-cols-2">
            <x-select label="Kategori" name="category_id" :list="$categories" livewire />
            <div class="space-x-4">
                <div class="mb-7"></div>
                <button
                    class="inline-flex items-center pl-3 pr-4 py-1.5 text-xs font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>NEW</span>
                </button>
            </div>
        </div>
        <x-date-picker label="Publish Date" name="published_at" livewire />
        <span class="text-xs text-gray-500">*Jika kosong, akan disimpan sebagai draft</span>
</div>
</div>
<div class="mt-5 md:mt-0 md:col-span-2">
    <div class="space-y-6">
        <x-input label="Judul" name="title" livewire />
        <x-input label="Slug" name="slug" livewire />
        <div wire:ignore>
            <textarea x-data="ckeditor()" x-init="init($dispatch)" wire:key="ckEditor" x-ref="ckEditor"
                wire:model.debounce.9999999ms="body"></textarea>
        </div>
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

@push('script')
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script>
    /**
         * An alpinejs app that handles CKEditor's lifecycle
         */
        function ckeditor() {
            return {
                /**
                 * The function creates the editor and returns its instance
                 * @param $dispatch Alpine's magic property
                 */
                create: async function($dispatch) {
                    // Create the editor with the x-ref
                    const editor = await ClassicEditor.create(this.$refs.ckEditor);
                    // Handle data updates
                    editor.model.document.on('change:data', function() {
                        $dispatch('input', editor.getData())
                    });
                    editor.editing.view.change( writer => {
                        writer.setStyle('height', '500px', editor.editing.view.document.getRoot());
                    });
                    // return the editor
                    return editor;
                },
                /**
                 * Initilizes the editor and creates a listener to recreate it after a rerender
                 * @param $dispatch Alpine's magic property
                 */
                init: async function($dispatch) {
                    // Get an editor instance
                    const editor = await this.create($dispatch);
                    // Set the initial data
                    {{--editor.setData('{{ old('description') }}')--}}
                    // Pass Alpine context to Livewire's
                    const $this = this;
                    // On reinit, destroy the old instance and create a new one
                    Livewire.on('reinit', async function(e) {
                        editor.setData('');
                        editor.destroy()
                            .catch( error => {
                                console.log( error );
                            } );
                        await $this.create($dispatch);
                    });
                }
            }
        }
</script>
@endpush
</div>
