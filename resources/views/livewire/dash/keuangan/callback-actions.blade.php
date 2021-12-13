<div class="flex items-center space-x-1">
    <form action="{{ route('dash.keuangan.recallback') }}" method="POST">
        @csrf
        <input type="hidden" name="data">
        <button type="submit" title="Proses Ulang"
            class="group p-2 border border-transparent rounded-full shadow-sm text-white bg-gray-200 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 group-hover:text-white" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </button>
    </form>
</div>
