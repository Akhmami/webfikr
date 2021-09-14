<div>
    @if (! empty($posts))
    <div class="relative bg-white pt-12 pb-4 sm:px-6 lg:py-12 lg:px-8">
        <div class="relative max-w-7xl mx-auto px-4">
            <div class="text-left">
                <h2 class="text-gray-800 text-3xl font-extrabold tracking-tight sm:text-4xl">
                    Artikel
                </h2>
                <div class="flex items-center mt-4 text-lg">
                    <a href="#" wire:click.prevent="$emit('newest')"
                        class="px-4 py-2 border-b-2 bg-gray-100 border-blue-500">Terbaru</a>
                    <a href="#" wire:click.prevent="$emit('popular')"
                        class="px-4 py-2 border-b-2 border-white hover:bg-gray-100 hover:border-blue-500">Populer</a>
                    <a href="#" wire:click.prevent="$emit('teacherNote')"
                        class="px-4 py-2 border-b-2 border-white hover:bg-gray-100 hover:border-blue-500">Pena Nurul
                        Fikri</a>
                </div>
            </div>

            <livewire:web.posts :posts="$posts" />

        </div>

        <div class="flex justify-center mt-10">
            <a href="{{url('/artikel')}}"
                class="mx-auto w-1/2 md:w-1/3 text-center px-4 py-3 border border-transparent text-base font-bold rounded-md shadow-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700">
                Lihat lebih banyak
            </a>
        </div>
    </div>
    @endif
</div>
