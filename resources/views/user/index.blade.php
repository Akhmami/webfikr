<x-user-layout>
    <main class="-mt-24 pb-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="sr-only">Profile</h1>
            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">
                <!-- Left column -->
                <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                    <!-- Billing -->
                    @include('user._billing')

                    <!-- Balance -->
                    @include('user._balance')

                    <!-- Recent Payment -->
                    @include('user._recent_payment')
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4">
                    @include('partials.user.sidebar')
                </div>
            </div>
        </div>
    </main>
</x-user-layout>
