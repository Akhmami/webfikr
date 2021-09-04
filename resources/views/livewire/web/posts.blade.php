<div>
    <div
        class="mt-12 max-w-lg mx-auto grid gap-5 md:gap-10 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:max-w-none lg:max-w-none">
        @foreach ($posts as $post)
        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
            <div class="flex-shrink-0">
                <img class="w-full object-cover" src="{{ $post->image_thumb_url }}" alt="{{ $post->title }}">
            </div>
            <div class="bg-white p-6">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 flex items-center space-x-2">
                        <a href="" class="bg-blue-600 text-xs text-white py-1 px-2 rounded-full">event</a>
                        <a href="#" class="hover:underline font-light">
                            {{ $post->pinned > 0 ? 'Disematkan' : $post->date }}
                        </a>
                    </p>
                    <a href="{{ route('post.show', $post->slug) }}" class="block mt-2">
                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $post->title }}
                        </h3>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
