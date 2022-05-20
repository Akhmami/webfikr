@extends('layouts.psb')

@section('meta')
<!-- meta social media facebook -->
<meta name="author" content="NFBS Serang">
<meta property="og:url" content="{{url('/')}}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="psb.nfbs.or.id" />
<meta property="article:publisher" content="https://www.facebook.com/nurulfikriserangbanten" />
<meta property="og:title" content="NFBS Serang - Cerdas, Sholeh dan Muslih" />
<meta property="og:description" content="Pendaftaran Santri Baru Nurul Fikri Boarding School Serang - Banten" />
<meta property="og:image" content="{{ asset('images/logo.png')}}" />
<meta property="og:image:width" content="700" />
<meta property="og:image:height" content="350" />
<meta property="revisit-after" content="7" />
<meta property="webcrawlers" content="all" />
<meta property="rating" content="general" />
<meta property="spiders" content="all" />
<meta property="robots" content="all" />
@endsection

@section('content')
<div
    class="max-w-6xl mx-auto mt-24 mb-8 relative bg-gray-100 overflow-hidden flex">

    <!-- Static sidebar for desktop -->

    <!-- Content area -->
    <div class="flex-1 flex flex-col">
        <main class="flex-1{{ Route::is('psb.index') ? '' : ' overflow-y-auto' }} focus:outline-none rounded-xl">
            <!-- Content -->
            <div class="relative max-w-4xl mx-auto md:px-8 xl:px-0">
                <div class="pt-16 pb-16 space-y-4">
                    <div class="px-4 sm:px-6 md:px-0">
                        <img class="rounded-xl" src="{{ asset('images/header-psb.jpeg') }}" alt="banner">
                    </div>
                    @if (!$expired)
                    <livewire:psb.eksternal-form :jalur_masuk="'mutasi'" />
                    @else
                    <div class="bg-white rounded-xl">
                        <div class="text-center py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
                            <h2 class="tracking-tight text-gray-900 sm:text-4xl">
                                <span class="block text-3xl font-extrabold">Pendaftaran Ditutup</span>
                                <span class="block text-xl text-gray-500 font-light">Silahkan login untuk melihat
                                    hasil.</span>
                            </h2>
                            <div class="mt-4 flex justify-center">
                                <div class="inline-flex rounded-md shadow">
                                    <a href="{{ route('user.home') }}"
                                        class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
