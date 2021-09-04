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
    <link href="{{ asset('css/webv2.css') }}" rel="stylesheet">
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

    <nav class="shadow-lg fixed left-0 right-0 z-20 bg-white top-0">
        <div class="bg-blue-500">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center text-gray-300 text-sm font-light">
                    <div class="flex items-center space-x-4">
                        <a href="#" class="hover:text-white">Info Penting</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('post.show', $info->slug) }}"
                            class="hover:text-white hover:underline">{{ Str::limit($info->title, 53) }}</a>
                    </div>
                    <div class="hidden md:flex items-center">
                        <p class="p-2">Ikuti kami </p>
                        <a href="https://facebook.com/nurulfikriserangbanten/" class="text-white bg-blue-700 p-2">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://instagram.com/nfbs_serang/" class="text-white bg-pink-500 p-2">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://twitter.com/nfbs_serang" class="text-white bg-blue-400 p-2">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>

                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = true"
                                class="inline-flex justify-center w-full pl-4 py-2 text-sm font-medium text-gray-700 focus:outline-none"
                                id="options-menu" aria-expanded="true" aria-haspopup="true">
                                <span class="sr-only">Lang</span>
                                <svg class="h-5 w-5" viewBox="0 0 640 480">
                                    <g fill-rule="evenodd" stroke-width="1pt">
                                        <path fill="#e70011" d="M0 0h639.958v248.947H0z" />
                                        <path fill="#fff" d="M0 240h639.958v240H0z" />
                                    </g>
                                </svg>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="z-10 px-4 py-2 absolute w-auto rounded-md shadow-lg bg-white" role="menu"
                                aria-orientation="vertical" aria-labelledby="options-menu">
                                <div class="py-1" role="none">
                                    <span class="sr-only">eng</span>
                                    <svg class="h-5 w-5" viewBox="0 0 640 480">
                                        <g fill-rule="evenodd" clip-path="url(#a)" transform="scale(.9375)">
                                            <g stroke-width="1pt">
                                                <g fill="#bd3d44">
                                                    <path
                                                        d="M0 0h972.81v39.385H0zM0 78.77h972.81v39.385H0zM0 157.54h972.81v39.385H0zM0 236.31h972.81v39.385H0zM0 315.08h972.81v39.385H0zM0 393.85h972.81v39.385H0zM0 472.62h972.81v39.385H0z" />
                                                </g>
                                                <g fill="#fff">
                                                    <path
                                                        d="M0 39.385h972.81V78.77H0zM0 118.155h972.81v39.385H0zM0 196.925h972.81v39.385H0zM0 275.695h972.81v39.385H0zM0 354.465h972.81v39.385H0zM0 433.235h972.81v39.385H0z" />
                                                </g>
                                            </g>
                                            <path fill="#192f5d" d="M0 0h389.12v275.69H0z" />
                                            <g fill="#fff">
                                                <path
                                                    d="M32.427 11.8l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM97.28 11.8l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zM162.136 11.8l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zM226.988 11.8l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zM291.843 11.8l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM356.698 11.8l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458z" />
                                                <g>
                                                    <path
                                                        d="M64.855 39.37l3.54 10.896h11.458L70.583 57l3.542 10.897-9.27-6.734-9.269 6.734L59.126 57l-9.269-6.734h11.458zM129.707 39.37l3.54 10.896h11.457L135.435 57l3.54 10.897-9.268-6.734-9.27 6.734L123.978 57l-9.27-6.734h11.458zM194.562 39.37l3.54 10.896h11.458L200.29 57l3.541 10.897-9.27-6.734-9.268 6.734L188.833 57l-9.269-6.734h11.457zM259.417 39.37l3.54 10.896h11.458L265.145 57l3.541 10.897-9.269-6.734-9.27 6.734L253.69 57l-9.27-6.734h11.458zM324.269 39.37l3.54 10.896h11.457L329.997 57l3.54 10.897-9.268-6.734-9.27 6.734L318.54 57l-9.27-6.734h11.458z" />
                                                </g>
                                                <g>
                                                    <path
                                                        d="M32.427 66.939l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM97.28 66.939l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zM162.136 66.939l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zM226.988 66.939l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zM291.843 66.939l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM356.698 66.939l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458z" />
                                                    <g>
                                                        <path
                                                            d="M64.855 94.508l3.54 10.897h11.458l-9.27 6.734 3.542 10.897-9.27-6.734-9.269 6.734 3.54-10.897-9.269-6.734h11.458zM129.707 94.508l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458zM194.562 94.508l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.27-6.734-9.268 6.734 3.54-10.897-9.269-6.734h11.457zM259.417 94.508l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.269-6.734-9.27 6.734 3.542-10.897-9.27-6.734h11.458zM324.269 94.508l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458z" />
                                                    </g>
                                                </g>
                                                <g>
                                                    <path
                                                        d="M32.427 122.078l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM97.28 122.078l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zM162.136 122.078l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zM226.988 122.078l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zM291.843 122.078l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM356.698 122.078l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458z" />
                                                    <g>
                                                        <path
                                                            d="M64.855 149.647l3.54 10.897h11.458l-9.27 6.734 3.542 10.897-9.27-6.734-9.269 6.734 3.54-10.897-9.269-6.734h11.458zM129.707 149.647l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458zM194.562 149.647l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.27-6.734-9.268 6.734 3.54-10.897-9.269-6.734h11.457zM259.417 149.647l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.269-6.734-9.27 6.734 3.542-10.897-9.27-6.734h11.458zM324.269 149.647l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458z" />
                                                    </g>
                                                </g>
                                                <g>
                                                    <path
                                                        d="M32.427 177.217l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM97.28 177.217l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zM162.136 177.217l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zM226.988 177.217l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zM291.843 177.217l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM356.698 177.217l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458z" />
                                                    <g>
                                                        <path
                                                            d="M64.855 204.786l3.54 10.897h11.458l-9.27 6.734 3.542 10.897-9.27-6.734-9.269 6.734 3.54-10.897-9.269-6.734h11.458zM129.707 204.786l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458zM194.562 204.786l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.27-6.734-9.268 6.734 3.54-10.897-9.269-6.734h11.457zM259.417 204.786l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.269-6.734-9.27 6.734 3.542-10.897-9.27-6.734h11.458zM324.269 204.786l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458z" />
                                                    </g>
                                                </g>
                                                <g>
                                                    <path
                                                        d="M32.427 232.356l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM97.28 232.356l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zM162.136 232.356l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zM226.988 232.356l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zM291.843 232.356l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zM356.698 232.356l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458z" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <!-- logo -->
                <div class="flex items-center py-2 mr-10">
                    <a href="{{ url('/') }}" class="text-blue-900 hover:text-white">
                        <img src="{{ asset('images/brand.svg') }}" class="w-auto h-10 object-contain" alt="Logo">
                    </a>
                </div>

                <!-- primary nav -->
                <div class="hidden md:flex items-center space-x-6 text-gray-600 font-semibold text-lg">
                    @forelse ($primaryMenu as $item)
                    @if ($item->submenus->count() > 0)
                    <div class="relative" x-data="{ open: false }">
                        <button type="button" @mouseover="open = true"
                            class="py-5 font-semibold text-lg group border-b border-white hover:border-blue-500 hover:text-gray-900 focus:outline-none"
                            aria-expanded="false">{{ $item->name }}
                        </button>
                        <div x-show="open" @mouseover.away="open = false" x-cloak
                            class="absolute z-10 left-1/2 transform -translate-x-1/2 px-2 w-screen max-w-xs sm:px-0">
                            <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                    @foreach ($item->submenus as $subitem)
                                    <a href="{{ $subitem->sub_url }}"
                                        class="-m-3 p-3 block rounded-md hover:bg-gray-50">
                                        <p class="text-base font-medium text-gray-900">
                                            {{ $subitem->sub_name }}
                                        </p>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{ url($item->url) }}"
                        class="py-5 hover:text-gray-900 border-b border-white hover:border-blue-500">
                        {{ $item->name }}
                    </a>
                    @endif
                    @empty
                    <a href="{{ url('/') }}"
                        class="py-5 hover:text-gray-900 border-b border-white hover:border-blue-500">
                        Beranda
                    </a>
                    @endforelse
                    <div class="relative" x-data="{ open: false }">
                        <button type="button" @click="open = true"
                            class="py-5 font-semibold text-lg group border-b border-white hover:text-gray-900 focus:outline-none"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                            class="absolute z-10 transform -translate-x-1/2 px-2 w-screen max-w-xs sm:px-0">
                            <div class="rounded-lg p-2">
                                <form action="{{url('/artikel')}}" method="GET">
                                    <input type="text" name="q" class="px-4 py-2" placeholder="Ketikan disini...">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- mobile button here -->
                <div class="md:hidden flex items-center">
                    <button class="mobile-menu-button">
                        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- mobile menu -->
        <div class="mobile-menu hidden md:hidden">
            @forelse ($primaryMenu as $item)
            @if ($item->submenus->count() > 0)
            <div x-data="{ open: false }">
                <a @click.prevent="open = true" href="#"
                    class="flex items-center space-x-1 py-2 px-4 text-sm hover:bg-gray-200">
                    <span>{{ $item->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                <div x-show="open" @click.away="open = false" class="px-4 py-2 bg-gray-100">
                    @foreach ($item->submenus as $subitem)
                    <a href="{{ url($subitem->sub_url) }}"
                        class="block py-2 px-4 text-sm hover:bg-gray-200">{{ $subitem->sub_name }}</a>
                    @endforeach
                </div>
            </div>
            @else
            <a href="{{ $item->url }}" class="block py-2 px-4 text-sm hover:bg-gray-200">{{ $item->name }}</a>
            @endif
            @empty
            <a href="{{ url('/') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Beranda</a>
            @endforelse
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 bg-opacity-90" aria-labelledby="footerHeading">
        <h2 id="footerHeading" class="sr-only">Footer</h2>
        <div class="max-w-7xl mx-auto py-12 px-8 lg:py-16 md:px-4">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <img class="h-11" src="images/brand2.svg" alt="NFBS Serang">
                    <p class="text-gray-300 text-base">
                        Merupakan sekolah berasrama yang mengintegrasikan program
                        pendidikan
                        ilmu agama Islam dan
                        ilmu umum.
                    </p>
                    <div class="flex space-x-2">
                        <a href="https://facebook.com/nurulfikriserangbanten"
                            class="text-gray-300 bg-gray-700 p-2 rounded">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a href="https://www.instagram.com/nfbs_serang/" class="text-gray-300 bg-gray-700 p-2 rounded">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a href="https://twitter.com/nfbs_serang" class="text-gray-300 bg-gray-700 p-2 rounded">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>

                        <a href="https://www.youtube.com/channel/UC4QdCSPm8ZHf1vezxYxhHDg"
                            class="text-gray-300 bg-gray-700 p-2 rounded">
                            <span class="sr-only">Youtube</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Services
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white">
                                        PSB
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white">
                                        Syarat pendaftaran
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white">
                                        Kontak
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Support
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white">
                                        Kalender pendidikan
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white">
                                        Ekstrakulikuler
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="text-base text-gray-300 hover:text-white">
                                        Kurikulum
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid">
                        <div class="flex items-start space-x-2">
                            <div class="p-2 text-red-500 bg-gray-700 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-gray-300">KP. CIHIDEUNG, JL. PALKA RT. 014 RW 004 BANTARWARU CINANGKA KAB.
                                SERANG BANTEN</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-500 pt-8">
                <p class="text-base text-gray-400 xl:text-center">
                    &copy; {{ date('Y') }} Organized by Yayasan Pesantren Ibnu Salam Nurul Fikri
                </p>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script src="{{ asset('js/webv2.js') }}"></script>
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
