<div>
    <div class="flex items-center justify-between">
        <div>Saldo</div>
        <div class="flex space-x-2 items-center">
            <span class="font-semibold text-lg">{{ rupiah($balance) }}</span>
            <button type="button" onclick="Livewire.emit('openModal', 'user.isi-saldo')"
                class="px-1 sm:px-3 py-1 border border-indigo-600 text-sm font-medium rounded text-indigo-600 bg-gradient-to-r hover:text-white hover:from-indigo-700 hover:to-blue-700">
                <span class="hidden sm:block">Isi Saldo</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="sm:hidden h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </button>
        </div>
    </div>
</div>
