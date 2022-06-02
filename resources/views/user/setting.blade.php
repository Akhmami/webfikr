<x-user-layout>
    <main class="relative -mt-24 pb-8">
        <div class="max-w-screen-xl mx-auto pb-6 px-4 sm:px-6 lg:pb-16 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div x-data="{ tab: window.location.hash ? window.location.hash : '#profile' }"
                    class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">

                    @include('partials.user.setting-menu')

                    <div x-show="tab == '#profile'" x-cloak class="divide-y divide-gray-200 lg:col-span-9">
                        <livewire:user.setting-profile />
                    </div>

                    <div x-show="tab == '#change-password'" x-cloak class="divide-y divide-gray-200 lg:col-span-9">
                        <livewire:user.setting-password />
                    </div>

                    <div x-show="tab == '#mobile-phones'" x-cloak class="divide-y divide-gray-200 lg:col-span-9">
                        <livewire:user.setting-phones />
                    </div>

                    <div x-show="tab == '#notifications'" x-cloak class="divide-y divide-gray-200 lg:col-span-9">
                        <livewire:user.setting-notifications />
                    </div>

                </div>
            </div>
        </div>
    </main>
</x-user-layout>
