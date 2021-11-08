<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
        content="Sekolah terbaik, boarding school, sekolah berasrama yang mengintegrasikan program pendidikan ilmu agama Islam dan ilmu umum">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    @hasSection('title')
    <title>@yield('title') - {{ config('app.name') }}</title>
    @else
    <title>NFBS Serang | YAYASAN PESANTREN IBNU SALAM NURUL FIKRI</title>
    @endif
    <link href="{{ asset('css/web.css') }}" rel="stylesheet">
    @livewireStyles
    @stack('style')
    <style>
        .video-container {
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .video-container::after {
            padding-top: 56.25%;
            display: block;
            content: '';
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-98459949-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-98459949-1');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M7464HZ');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="bg-gray-100">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M7464HZ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <a href="https://wa.me/6287780775548" target="_blank"
        class="z-20 fixed bottom-0 right-0 mr-10 mb-10 cursor-pointer p-3 rounded-full shadow-lg"
        style="background-color: #25d366">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" width="44" height="44" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
            <path
                d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1" />
        </svg>
    </a>

    @include('layouts.web.navbar')

    @yield('content')

    <!-- Footer -->
    @include('layouts.web.footer')

    @livewireScripts
    <script src="{{ asset('js/web.js') }}"></script>
    @stack('script')
    <script>
        // grab everything we need
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        // add event listeners
        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    </script>

    <!-- Popup -->
    @if (!empty($popup))
    @if ($popup->frequency == 'OL')
    <script>
        $(window).on('load', function(){
                        if(sessionStorage.getItem('#popup') !== 'true') {
                            $('#popup').modal('show');
                            //call once
                            sessionStorage.setItem('#popup', 'true');
                        }
                    });
    </script>
    @else
    <script>
        $(window).on('load', function () {
                        $('#popup').modal('show');
                    });
    </script>
    @endif
    @endif
</body>

</html>
