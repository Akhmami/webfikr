@props([
'type' => 'success'
])

<!--
      Modal panel, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        To: "opacity-100 translate-y-0 sm:scale-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100 translate-y-0 sm:scale-100"
        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    -->
<div
    class="inline-block align-bottom bg-white rounded-lg px-4 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:w-full sm:p-6">
    <div>
        <div
            class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-{{$type === 'success' ? 'green' : 'red'}}-100">
            @if ($type === 'success')
            <!-- Heroicon name: outline/check -->
            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            @else
            <!-- Heroicon name: outline/x -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            @endif
        </div>
        <div class="mt-3 text-center sm:mt-5">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                {{ $title }}
            </h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">
                    {!! $description !!}
                </p>
            </div>
        </div>
    </div>
    <div class="mt-5 sm:mt-6 flex justify-center items-center">
        {{ $buttons }}
    </div>
</div>
