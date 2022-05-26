@if (auth()->user()->grades()->count() > 0)
<section aria-labelledby="quick-links-title">
    <div class="rounded-lg bg-gray-50 overflow-hidden shadow divide-y divide-gray-200 sm:divide-y-0">
        <h2 class="sr-only" id="quick-links-title">Balance</h2>

        <div class="col-span-2 bg-white px-6 py-4 rounded-tl-lg rounded-tr-lg">
            <livewire:user.topup-balance />
        </div>

        <div class="flex p-4 space-x-4">
            <a href="{{ route('user.spp') }}" class="group">
                <div class="flex flex-col space-y-1 items-center">
                    <div>
                        <div
                            class="rounded-lg inline-flex p-3 bg-gradient-to-br from-teal-200 to-teal-500 text-teal-800 ring-4 ring-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-sm font-bold">
                        SPP
                    </div>
                </div>
            </a>

            <a href="{{ route('user.pas') }}" class="group">
                <div class="flex flex-col space-y-1 items-center">
                    <div>
                        <div
                            class="rounded-lg inline-flex p-3 bg-gradient-to-br from-blue-200 to-blue-500 text-blue-800 ring-4 ring-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-sm font-bold">
                        e-Ujian
                    </div>
                </div>
            </a>

            <a href="{{ route('user.spp') }}" class="group">
                <div class="flex flex-col space-y-1 items-center">
                    <div>
                        <div
                            class="rounded-lg inline-flex p-3 bg-gradient-to-br from-gray-200 to-gray-500 text-gray-800 ring-4 ring-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-sm font-bold">
                        Lainnya
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@endif