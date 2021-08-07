<div>
    <div class="mb-6">
        <div class="mb-2 flex items-center justify-between py-1">
            <div class="text-md font-medium uppercase text-gray-700">
                Balance
            </div>
            <button @click="isClose = false" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div class="bg-white rounded shadow">
            <div class="flex items-center space-x-4 p-4">
                <div class="rounded-full bg-blue-100 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">
                        Pemasukan
                        <select wire:model.lazy="month" class="border-0 w-28 p-0 text-xs font-semibold">
                            @for ($i = date('n'); $i > 0; $i--) <option value="{{ date('Y') .'-'. $i }}">
                                {{ tanggal($i, 'm') .' '. date('Y') }}</option>
                            @endfor
                        </select>
                    </p>
                    <p class="text-xl text-gray-700 font-semibold">{{  rupiah($amount) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
