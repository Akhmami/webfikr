<x-dash-layout>
    <x-slot name="breadtitle">
        Settings
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto mb-6">
            <livewire:dash.psb.menu />
        </div>
        <div class="flex space-x-4">
            <div class="w-full">
                <div class="bg-white rounded-xl divide-y">
                    <div class="divide-y">
                        <div class="flex items-center justify-between px-4 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Setting PSB
                            </div>
                        </div>
                        <div class="rounded-b flex flex-col">
                            <div x-data="{ tab: window.location.hash ? window.location.hash : '#gelombang' }"
                                class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">

                                @include('dash.psb.settings-menu')

                                <div x-show="tab == '#gelombang'" x-cloak class="lg:col-span-10">
                                    @csrf
                                    @method('PUT')
                                    <!-- Profile section -->
                                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                        <div class="flex justify-between items-center">
                                            <h2 class="text-lg leading-6 font-medium text-gray-900">
                                                Gelombang
                                            </h2>
                                            <button type="button"
                                                onclick="Livewire.emit('openModal', 'dash.psb.gelombang-create')"
                                                class="inline-flex items-center pl-3 pr-4 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>NEW</span>
                                            </button>
                                        </div>

                                        <div class="mt-6">
                                            <livewire:dash.psb.gelombangs-table />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @once
    @push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ mix('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        var editor_config = {
                path_absolute : "/",
                selector: '.editor',
                height: 400,
                relative_urls: false,
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table directionality",
                    "emoticons template paste textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                file_picker_callback : function(callback, value, meta) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                    if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                    } else {
                    cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                    });
                }
                };
                tinymce.init(editor_config);
    </script>
    @endpush
    @endonce
</x-dash-layout>
