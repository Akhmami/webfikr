@props([
'disabled' => false,
'livewire' => false,
'label',
'name',
'value'
])

<div>
    @if (!empty($label))
    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif
    <div class="mt-1 relative rounded-md shadow-sm">
        <textarea {{ $livewire ? 'wire:model.lazy' : 'name' }}="{{ $name }}" rows="3" {!! $attributes->merge(['class' => 'block
        w-full focus:outline-none border-gray-300
        sm:text-sm rounded-md' ]) !!} @error($name) {!! $attributes->merge(['class' => 'pr-10
        border-red-300 text-red-900 focus:ring-red-500 focus:border-red-500' ]) !!}
        @enderror
        {{ $disabled ? 'disabled' : '' }}>{!! old($name) ?: ($value ?? null) !!}</textarea>
        @error ($name)
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <!-- Heroicon name: solid/exclamation-circle -->
            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        @enderror
    </div>
    @error ($name)
    <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
    @enderror
</div>
