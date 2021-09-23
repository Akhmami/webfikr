<x-dash-layout>
    <x-slot name="breadtitle">
        Posts
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
                                Posts
                            </div>
                        </div>
                        <div class="rounded-b flex flex-col">
                            <div x-data="{ tab: window.location.hash ? window.location.hash : '#alur-pendaftaran' }"
                                class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">

                                @include('dash.psb.posts-menu')

                                @foreach ($posts as $post)
                                <div x-show="tab == '#{{$post->slug}}'" x-cloak
                                    class="divide-y divide-gray-200 lg:col-span-9">
                                    <form action="{{ route('dash.psb.posts-update', $post->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <!-- Profile section -->
                                        <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                            <div>
                                                <h2 class="text-lg leading-6 font-medium text-gray-900">
                                                    {{ $post->title }}</h2>
                                            </div>

                                            <div class="mt-6">
                                                <textarea id="editor{{$post->id}}"
                                                    name="content">{!! $post->content !!}</textarea>
                                            </div>
                                        </div>

                                        <div class="py-4 px-6 float-right">
                                            <button
                                                class="flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @once
    @push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
        var numb = 1;
        do {
            ClassicEditor
                .create(document.querySelector('#editor' + numb))
                .then(editor => {
                    editor.editing.view.change(writer=>{
                        writer.setStyle('height', '400px', editor.editing.view.document.getRoot());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
            numb++;
        }
        while (numb < 8); });
    </script>
    @endpush
    @endonce
</x-dash-layout>
