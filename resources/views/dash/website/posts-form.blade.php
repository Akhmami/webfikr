<x-dash-layout>
    <x-slot name="breadtitle">
        Buat Artikel
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto mb-4">
            <livewire:dash.website.menu />
        </div>
        <div class="flex space-x-4">
            <div class="w-full">
                <div class="bg-white rounded-xl">
                    <livewire:dash.website.posts-form :postId="$postId" />
                </div>
            </div>
        </div>
    </main>
</x-dash-layout>
