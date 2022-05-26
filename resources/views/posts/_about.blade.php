<!-- Tentang Kami -->
<div class="relative bg-gray-800">
    <div class="h-56 bg-indigo-600 sm:h-72 md:absolute md:left-0 md:h-full md:w-1/2">
        <div class="video-container z-10 h-full">
            <iframe src="{{ $about->url_embed }}" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <div class="md:ml-auto md:w-1/2 md:pl-10">
            <h2 class="text-white text-3xl font-extrabold tracking-tight sm:text-4xl">
                Tentang Kami
            </h2>
            <p class="mt-3 text-lg text-gray-300">
                {!! $about->body !!}
            </p>
            <div class="mt-8">
                <div class="rounded-md shadow">
                    <a href="{{ $about->url_read_more }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-gray-900 bg-white hover:bg-blue-600 hover:text-white">
                        Selengkapnya<span aria-hidden="true"> &nbsp; &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
