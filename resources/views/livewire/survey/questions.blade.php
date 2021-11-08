<div>
    <form wire:submit.prevent="store" class="flex flex-col space-y-8">
        @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        @forelse ($questionnaire->questions as $question)
        <div>
            <label for="answer" class="block font-medium text-gray-700">{{ $question->question
                }}</label>
            <div class="mt-2 border-b border-gray-300 focus-within:border-indigo-600">
                <input type="text" wire:model.lazy="answer.{{$question->id}}"
                    class="block w-full border-0 border-b border-transparent bg-gray-50 focus:border-indigo-600 focus:ring-0 sm:text-sm"
                    placeholder="Masukan jawaban">
            </div>
            @error ('answer.'.$question->id)
            <p class="mt-2 text-xs font-semibold text-red-600" id="email-error">{{ $message }}</p>
            @enderror
        </div>
        @empty
        Empty
        @endforelse
        <div class="sm:col-span-2 sm:flex sm:justify-end">
            <button type="submit"
                class="mt-2 w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-teal-500 hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:w-auto">
                Submit
            </button>
        </div>
    </form>
</div>
