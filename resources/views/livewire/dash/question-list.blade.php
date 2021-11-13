<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Daftar Pertanyaan Questionnaire {{ $questionnaire->name }}
            </h3>
        </div>
        <div class="px-4 border-t border-gray-200">
            <dl>
                @foreach ($questions as $question)
                <div class="py-4 sm:py-5 sm:flex items-center">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ $question->question }}
                    </dt>
                    <dd class="mt-1 flex justify-end space-x-2 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <button type="button"
                            onclick="Livewire.emit('openModal', 'dash.question-edit', {{ json_encode(['question' => $question->id]) }})"
                            title="edit"
                            class="group inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-gray-200 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 group-hover:text-white"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>

                        <button type="button" wire:click.prevent="destroy({{ $question->id }})" title="hapus"
                            class="group inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-gray-200 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                            <!-- Heroicon name: solid/x -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 group-hover:text-white"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </dd>
                </div>
                @endforeach
            </dl>
        </div>
    </div>
</div>
