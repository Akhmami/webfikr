<x-dash-layout>
    <x-slot name="breadtitle">
        Keuangan
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto mb-6">
            <livewire:dash.keuangan.menu />
        </div>
        <div class="flex space-x-4">
            <div class="w-full">
                <livewire:dash.keuangan.report-tiles />
            </div>
        </div>
    </main>
</x-dash-layout>
