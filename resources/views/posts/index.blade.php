@extends('layouts.web')

@section('meta')
<!-- meta social media facebook -->
<meta name="author" content="NFBS">
<meta property="og:url" content="{{url('/')}}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="nfbs.or.id" />
<meta property="article:publisher" content="https://www.facebook.com/nurulfikriserangbanten" />
<meta property="og:title" content="NFBS Serang - Cerdas, Sholeh dan Muslih" />
<meta property="og:description"
    content="Sekolah terbaik, sekolah berasrama yang mengintegrasikan program pendidikan ilmu agama Islam dan ilmu umum" />
<meta property="og:image" content="{{url('/img/logo.png')}}" />
<meta property="og:image:width" content="700" />
<meta property="og:image:height" content="350" />
<meta property="revisit-after" content="7" />
<meta property="webcrawlers" content="all" />
<meta property="rating" content="general" />
<meta property="spiders" content="all" />
<meta property="robots" content="all" />
@endsection

@push('style')
<style>
    .swal-wide {
        @apply w-10/12;
    }

    @media (min-width: 768px) {
        .swal-wide {
            min-width: 60%;
        }
    }
</style>
@endpush

@section('content')

@include('partials.slideshow', ['data' => $sliders])
@include('partials.cta')
@include('partials.about')

<!-- Artikel -->
<livewire:web.blog-post />

@include('partials.achievement')
@include('partials.program')
@include('partials.facility')
@include('partials.alumni')
{{-- @include('partials.testimonial') --}}

<div class="hidden">
    <img id="popup" src="{{ asset('images/popup.jpeg') }}" class="w-full rounded">
</div>
@endsection

@push('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    new Splide('#image-slider', {
        type: 'loop',
        speed: 1000,
        autoplay: true,
        interval: 4000,
    }).mount();
</script>
<script>
    var image = document.querySelector("#popup");
    swal({
    button: false,
    className: "swal-wide",
    content: image
    ,
    });
</script>
@endpush
