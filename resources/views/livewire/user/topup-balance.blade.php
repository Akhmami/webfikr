<div>
    <div class="flex items-center justify-between">
        <div>Total Saldo</div>
        <div class="flex space-x-2 items-center">
            <span class="font-semibold text-lg">{{ rupiah($balance) }}</span>
            <button type="button" onclick="Livewire.emit('openModal', 'user.isi-saldo')"
                class="px-3 py-1 border border-indigo-600 text-sm font-medium rounded text-indigo-600 bg-gradient-to-r hover:text-white hover:from-indigo-700 hover:to-blue-700">Isi
                Saldo</button>
        </div>
    </div>
</div>
