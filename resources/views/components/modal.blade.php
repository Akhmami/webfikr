@props(['action' => false])

<div>
    @if($action)
    <form wire:submit.prevent="{{ $action }}">
        @endif

        <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
            @if(isset($title))
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $title }}
            </h3>
            @endif
        </div>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            {{ $content }}
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            {{ $buttons }}
        </div>

        @if($action)
    </form>
    @endif
</div>
