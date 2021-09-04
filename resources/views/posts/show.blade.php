@extends('layouts.web')

@section('meta')
<meta name="author" content="{{ $post->user->name }}">
<meta name="description" content="{{str_excerpt(strip_tags($post->body))}}">
<meta property="description" content="{{str_excerpt(strip_tags($post->body))}}">
<meta property="og:url" content="{{URL::current()}}" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="nfbs.or.id" />
<meta property="article:publisher" content="https://www.facebook.com/nurulfikriserangbanten" />
<meta property="og:title" content="{{ $post->title }}" />
<meta property="og:description" content="{{str_excerpt(strip_tags($post->body))}}" />
<meta property="og:image" content="{{ $post->image_url }}" />
<meta property="og:image:width" content="700" />
<meta property="og:image:height" content="350" />
<meta property="revisit-after" content="7" />
<meta property="webcrawlers" content="all" />
<meta property="rating" content="general" />
<meta property="spiders" content="all" />
<meta property="robots" content="all" />
@endsection

@section('title')
{{ $post->title }}
@endsection

@push('style')
<style>
    .content>p>* {
        font-family: 'Inter', sans-serif !important;
        line-height: 2rem !important;
    }
</style>
@endpush

@section('content')
<div class="mb-24 md:pb-2"></div>
<div class="bg-gray-50">
    <div class="max-w-prose mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-center">
        <h2 class="text-2xl font-semibold tracking-tight text-gray-900 md:text-3xl text-center">
            <span class="block text-gray-900">{{ $post->title }}</span>
            <span class="text-gray-100 text-sm font-light">
                <a href="{{ route('category', $post->category->slug) }}"
                    class="px-4 py-1 bg-blue-600 rounded-full">{{ $post->category->title }}</a>
                <span class="text-gray-500">{{ $post->date }}</span>
            </span>
        </h2>
    </div>
</div>

<div class="relative py-16 bg-white overflow-hidden">
    <div class="hidden lg:block lg:absolute lg:inset-y-0 lg:h-full lg:w-full">
        <div class="relative h-full text-lg max-w-prose mx-auto" aria-hidden="true">
            <svg class="absolute top-12 left-full transform translate-x-32" width="404" height="384" fill="none"
                viewBox="0 0 404 384">
                <defs>
                    <pattern id="74b3fd99-0a6f-4271-bef2-e80eeafdf357" x="0" y="0" width="20" height="20"
                        patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="384" fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)" />
            </svg>
            <svg class="absolute top-1/2 right-full transform -translate-y-1/2 -translate-x-32" width="404" height="384"
                fill="none" viewBox="0 0 404 384">
                <defs>
                    <pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20" height="20"
                        patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="384" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)" />
            </svg>
            <svg class="absolute bottom-12 left-full transform translate-x-32" width="404" height="384" fill="none"
                viewBox="0 0 404 384">
                <defs>
                    <pattern id="d3eb07ae-5182-43e6-857d-35c643af9034" x="0" y="0" width="20" height="20"
                        patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="384" fill="url(#d3eb07ae-5182-43e6-857d-35c643af9034)" />
            </svg>
        </div>
    </div>
    <div class="relative px-4 sm:px-6 lg:px-8">
        <div class="text-lg max-w-prose mx-auto content">
            <img class="w-full rounded-lg" src="{{ $post->image_url }}" alt="{{ $post->title }}">
            <p class="mt-8 text-xl text-gray-500 leading-8">
                {!! $post->body !!}
            </p>
        </div>
    </div>
</div>
<div class="px-4 sm:px-6 lg:px-8">
    <div class="max-w-prose mx-auto">
        <div id="disqus_thread"></div>
    </div>
</div>
@endsection

@push('script')
{{-- Disqus Api's --}}
<script>
    var disqus_config = function() {
          this.page.url = "{!! route('post.show', $post->slug) !!}"; // Replace PAGE_URL with your page's canonical URL variable
          this.page.identifier = "{{ $post->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function() { // DON'T EDIT BELOW THIS LINE
          var d = document,
            s = d.createElement('script');
          s.src = 'https://nfbs-serang.disqus.com/embed.js';
          s.setAttribute('data-timestamp', +new Date());
          (d.head || d.body).appendChild(s);
        })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
        Disqus.</a></noscript>
@endpush
