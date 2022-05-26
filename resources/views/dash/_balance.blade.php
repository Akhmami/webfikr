<div>
    <div class="text-md font-medium uppercase text-gray-700 mb-2">
        Balance
    </div>
    <div class="bg-white rounded-xl">
        <div class="flex items-center space-x-4 p-4">
            <div class="rounded-full bg-green-100 p-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">
                    Income bulan
                    <select name="" class="border-0 w-32 p-0 text-sm font-semibold">
                        @for ($i = 1; $i <= 12; $i++) <option value="{{ $i .'-'. date('Y') }}">
                            {{ tanggal($i, 'm') .' '. date('Y') }}</option>
                            @endfor
                    </select>
                </p>
                <p class="text-2xl text-gray-700 font-semibold">Rp 1.000.000</p>
            </div>
        </div>
    </div>
</div>