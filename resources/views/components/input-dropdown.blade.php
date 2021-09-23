@props([
'disabled' => false,
'livewire' => false,
'type' => 'text',
'selected' => '',
'label',
'name',
'dropdown_name',
'value',
'dropdown' => []
])

<div>
    @if (!empty($label))
    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif
    @php
    if($errors->has($name)){
    $class = 'pr-10 border-red-300 border-2 text-red-900 focus:ring-red-500 focus:border-red-500 block w-full
    focus:outline-none sm:text-sm rounded-md';
    } else {
    $class = 'block w-full focus:outline-none sm:text-sm rounded-md border-gray-300';
    }
    @endphp
    <div class="mt-1 relative rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-0 flex items-center w-20">
            <label for="country" class="sr-only">Country</label>
            <select id="country" wire:model="{{ $dropdown_name }}"
                class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-3 pr-5 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                required>
                <option value="">Pilih</option>
                @forelse ($dropdown as $key => $val)
                <option value="{{ $key }}" @if($selected==$key) selected @endif>{{ $val }}</option>
                @empty

                @endforelse
            </select>
        </div>
        <input type="{{ $type }}" {{ $livewire ? 'wire:model.lazy' : 'name' }}="{{ $name }}" {!!
            $attributes->merge(['class'
        => $class ]) !!}
        value="{{ !empty($value) ? $value : '' }}"
        {{ $disabled ? 'disabled' : '' }}>
    </div>
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
