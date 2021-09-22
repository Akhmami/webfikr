<x-dash-layout>
    <x-slot name="breadtitle">
        Status PSB
    </x-slot>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto mb-6">
            <livewire:dash.psb.menu />
        </div>
        <div class="flex space-x-4">
            <div class="w-full">
                <div class="bg-white rounded-xl divide-y">
                    <div class="divide-y">
                        <div class="flex items-center justify-between px-4 py-4">
                            <div class="text-md font-medium uppercase text-gray-700">
                                Status PSB Overview
                            </div>
                        </div>
                        <div class="rounded-b flex flex-col px-4 py-4">
                            <livewire:dash.psb.status-psb />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-dash-layout>
