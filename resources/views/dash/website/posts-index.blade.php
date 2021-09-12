<x-dash-layout>
    <x-slot name="breadtitle">
        Posts
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto mb-4">
            <livewire:dash.website.menu />
        </div>
        <div class="flex space-x-4">
            <div class="w-full">
                <div class="bg-white rounded-xl divide-y">
                    <div class="divide-y">
                        <div class="flex items-center justify-between px-4 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Daftar Artikel
                            </div>
                            <a href="{{ route('dash.webiste.create', 'posts') }}" class="inline-flex items-center pl-3 pr-4 py-1.5 text-xs
                                                    font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none
                                                    focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>NEW</span>
                            </a>
                        </div>
                        <div class="rounded-b flex flex-col px-4 py-4">
                            <livewire:dash.website.posts-table />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-dash-layout>
