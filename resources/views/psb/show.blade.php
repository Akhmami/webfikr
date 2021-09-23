<div class="px-4 sm:px-6 bg-white rounded-xl">
    <div class="py-6">
        <!-- Description list with inline editing -->
        <div class="divide-y divide-gray-200">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $post->title }}
                    </h3>
                </div>
                <div class="inline-flex items-center">
                    <a href="{{ route('psb.index') }}"
                        class="ml-4 whitespace-nowrap inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 bg-origin-border px-6 py-2 border border-transparent rounded-lg shadow-sm text-base font-medium text-white hover:from-purple-700 hover:to-indigo-700">
                        DAFTAR SEKARANG
                    </a>
                </div>
            </div>
            <div class="mt-6 prose lg:prose-xl"">
                {!! $post->content !!}
            </div>
        </div>
    </div>
</div>
