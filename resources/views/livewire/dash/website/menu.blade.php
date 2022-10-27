<div>
    <div class="flex space-x-2 flex-nowrap">
        <a href="{{ route('dash.views', 'posts') }}" class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-blue-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">{{ $articles }} Artikel</p>
                </div>
            </div>
        </a>
        <a href="{{ route('dash.views', 'slideshows') }}"
            class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-yellow-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">{{ $slideshows }} Slideshow</p>
                </div>
            </div>
        </a>
        <a href="{{ route('dash.views', 'categories') }}"
            class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-green-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">{{ $categories }} Kategori</p>
                </div>
            </div>
        </a>
        <a href="{{ route('dash.views', 'posts') }}?filters[category_id]=5"
            class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-red-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">{{ $info }} Info Penting</p>
                </div>
            </div>
        </a>
        <a href="{{ route('dash.views', 'about-us') }}" class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-indigo-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">Tentang Kami</p>
                </div>
            </div>
        </a>
        <a href="#" class="bg-white rounded-xl w-56 hover:bg-cyan-50 hover:shadow">
            <div class="flex items-center space-x-4 p-2">
                <div class="rounded-xl bg-gray-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">Lainnya</p>
                </div>
            </div>
        </a>
    </div>
</div>
