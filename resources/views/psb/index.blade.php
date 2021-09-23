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
    class="max-w-6xl mx-auto mt-24 mb-8 relative{{ Route::is('psb.index') ? '' : ' h-screen' }} bg-gray-100 overflow-hidden flex">

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="w-80 flex flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <nav class="pt-16 pb-4 flex flex-col flex-grow overflow-y-auto">
                <div class="px-4 grid grid-cols-2 gap-4 justify-center">
                    <a href="{{ url('alur-pendaftaran') }}"
                        class="flex flex-col space-y-2 items-center p-4 rounded-xl text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-300 hover:to-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <div class="text-sm text-center">Alur Pendaftaran</div>
                    </a>
                    <a href="{{ route('psb.internal') }}"
                        class="flex flex-col space-y-2 items-center p-4 rounded-xl text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-300 hover:to-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <div class="text-sm text-center">Santri Internal</div>
                    </a>
                    <a href="{{ url('persyaratan') }}"
                        class="flex flex-col space-y-2 items-center p-4 rounded-xl text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-300 hover:to-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm text-center">Persyaratan</div>
                    </a>
                    <a href="{{ url('biaya-pendidikan') }}"
                        class="flex flex-col space-y-2 items-center p-4 rounded-xl text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-300 hover:to-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <div class="text-sm text-center">Biaya Pendidikan</div>
                    </a>
                    <a href="{{ url('asrama') }}"
                        class="flex flex-col space-y-2 items-center p-4 rounded-xl text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-300 hover:to-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <div class="text-sm text-center">Asrama</div>
                    </a>
                    <a href="{{ url('berkas-kesehatan') }}"
                        class="flex flex-col space-y-2 items-center p-4 rounded-xl text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-300 hover:to-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <div class="text-sm text-center">Berkas Kesehatan</div>
                    </a>
                    <a href="{{ url('tanggal-penting') }}"
                        class="flex flex-col space-y-2 items-center p-4 rounded-xl text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-300 hover:to-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div class="text-sm text-center">Tanggal Penting</div>
                    </a>
                    <a href="{{ url('brosur-online') }}"
                        class="flex flex-col space-y-2 items-center p-4 rounded-xl text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-300 hover:to-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        <div class="text-sm text-center">Brosur Online</div>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Content area -->
    <div class="flex-1 flex flex-col">
        <main class="flex-1{{ Route::is('psb.index') ? '' : ' overflow-y-auto' }} focus:outline-none rounded-xl">
            <!-- Mobile section -->
            <div class="md:hidden py-6 px-2 sm:px-6 lg:py-0 lg:px-0 lg:col-span-3">
                <nav class="space-y-1">
                    <!-- Current: "bg-gray-50 text-orange-600 hover:bg-white", Default: "text-gray-900 hover:text-gray-900 hover:bg-gray-50" -->
                    <a href="#"
                        class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
                        <!--
                          Heroicon name: outline/user-circle

                          Current: "text-orange-500", Default: "text-gray-400 group-hover:text-gray-500"
                        -->
                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="truncate">
                            Profile
                        </span>
                    </a>

                    <a href="#"
                        class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
                        <!-- Heroicon name: outline/cog -->
                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="truncate">
                            Account
                        </span>
                    </a>

                    <a href="#"
                        class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
                        <!-- Heroicon name: outline/key -->
                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                        <span class="truncate">
                            Password
                        </span>
                    </a>

                    <a href="#"
                        class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
                        <!-- Heroicon name: outline/bell -->
                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="truncate">
                            Notifications
                        </span>
                    </a>

                    <a href="#"
                        class="bg-gray-50 text-orange-600 hover:bg-white group rounded-md px-3 py-2 flex items-center text-sm font-medium"
                        aria-current="page">
                        <!-- Heroicon name: outline/credit-card -->
                        <svg class="text-orange-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span class="truncate">
                            Plan &amp; Billing
                        </span>
                    </a>

                    <a href="#"
                        class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
                        <!-- Heroicon name: outline/view-grid-add -->
                        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                        </svg>
                        <span class="truncate">
                            Integrations
                        </span>
                    </a>
                </nav>
            </div>
            <!-- Content -->
            <div class="relative max-w-4xl mx-auto md:px-8 xl:px-0">
                <div class="pt-16 pb-16 space-y-4">
                    <div class="px-4 sm:px-6 md:px-0">
                        <img class="rounded-xl" src="https://source.unsplash.com/q10VITrVYUM/900x200" alt="banner">
                    </div>
                    @if (Route::is('psb.index'))
                    @if (!$expired)
                    <livewire:psb.eksternal-form />
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
                    @else
                    @if (Route::is('psb.internal'))
                    <livewire:psb.internal-form />
                    @else
                    @include('psb.show')
                    @endif
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>

@endsection
