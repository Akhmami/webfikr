<div class="flex flex-col space-y-2">
    <a href="{{ route('post.show', $data->slug) }}" target="_blank"
        class="text-blue-800 font-semibold break-words hover:underline">{{ $data->title }}</a>
    <div class="flex items-center space-x-2">
        <div>
            {!! $data->publicationLabel() !!}
            &#8729;
            <span class="text-gray-600 text-sm">{{ $data->date }}</span>
        </div>
        <div>
            <span
                class="inline-flex items-center px-2.5 py-0.5 border border-gray-300 shadow-sm text-xs font-light rounded-full text-gray-500 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ $data->category->title }}
            </span>
        </div>
    </div>
</div>
