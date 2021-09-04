@extends('layouts.web')

@section('content')
<div class="mb-24 md:pb-2"></div>
@include('partials.cta')

<!-- Artikel -->
@if (! empty($posts))
<div class="relative bg-white pt-12 pb-4 px-4 sm:px-6 lg:py-12 lg:px-8">
    <div class="relative max-w-7xl mx-auto px-4">
        <div class="text-left">
            <h2 class="text-gray-800 text-3xl font-extrabold tracking-tight sm:text-4xl">
                Artikel
            </h2>
        </div>
        <div
            class="mt-12 max-w-lg mx-auto grid gap-5 md:gap-10 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:max-w-none lg:max-w-none">
            @foreach ($posts as $post)
            <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                <div class="flex-shrink-0">
                    <img class="h-52 w-full object-cover" src="{{ $post->image_thumb_url }}" alt="{{ $post->title }}">
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

    <div class="flex justify-center mt-10">
        {!! $posts->links() !!}
    </div>
</div>
@endif
@endsection
