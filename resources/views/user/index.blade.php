<x-user-layout>
    <main class="-mt-24 pb-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="sr-only">Profile</h1>
            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">
                <!-- Left column -->
                <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                    <!-- Welcome panel -->
                    <livewire:user.bill />

                    <!-- Actions panel -->
                    <section aria-labelledby="quick-links-title">
                        <div
                            class="rounded-lg bg-gray-200 overflow-hidden shadow divide-y divide-gray-200 sm:divide-y-0 sm:grid sm:grid-cols-2 sm:gap-px">
                            <h2 class="sr-only" id="quick-links-title">Quick links</h2>

                            <div class="col-span-2 bg-white px-6 py-4 rounded-tl-lg rounded-tr-lg">
                                Balance
                            </div>

                            <a href="{{ route('user.spp') }}"
                                class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-cyan-500">
                                <div class="flex items-center space-x-2">
                                    <span class="rounded-lg inline-flex p-3 bg-teal-50 text-teal-700 ring-4 ring-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </span>
                                    <span class="text-lg">
                                        SPP
                                    </span>
                                </div>
                            </a>

                            <a href="#"
                                class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-cyan-500">
                                <div class="flex items-center space-x-2">
                                    <span class="rounded-lg inline-flex p-3 bg-sky-50 text-sky-700 ring-4 ring-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                    </span>
                                    <span class="text-lg">
                                        Liannya
                                    </span>
                                </div>
                            </a>
                        </div>
                    </section>

                    <!-- Recent Payment -->
                    <livewire:user.recent-payment />
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4">
                    @include('layouts.user.sidebar')
                </div>
            </div>
        </div>
    </main>
</x-user-layout>
