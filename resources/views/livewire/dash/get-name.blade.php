<div>
    <x-modal action="get">
        <x-slot name="title">
            {{ $title }}
        </x-slot>

        <x-slot name="content">
            <input wire:model="term" class="block w-full focus:outline-none sm:text-sm rounded-md" type="text" />

            <div wire:loading.remove>
                <!--
                    notice that $term is available as a public
                    variable, even though it's not part of the
                    data array
                -->
                @if ($term == "")
                <div class="text-gray-500 text-sm">
                    Ketikan nama untuk mencari
                </div>
                @else
                @if($users->isEmpty())
                <div class="text-gray-500 text-sm">
                    No matching result was found.
                </div>
                @else
                <div>
                    <div class="flow-root mt-6">
                        <ul class="-my-5 divide-y divide-gray-200">
                            @foreach($users as $user)
                            <li class="py-5">
                                <div class="relative focus-within:ring-2 focus-within:ring-indigo-500">
                                    <h3 class="text-sm font-semibold text-gray-800">
                                        <button type="button"
                                            onclick="Livewire.emit('openModal', '{{ $path }}', {{ json_encode(['user_id' => $user->id]) }})"
                                            class="hover:underline focus:outline-none">
                                            <!-- Extend touch target to entire panel -->
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            {{ $user->name }}
                                        </button>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-600 line-clamp-2">
                                        Username: {{ $user->username }}, Email: {{ $user->email }}
                                    </p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="px-4 mt-4">
                        {{$users->links()}}
                    </div>
                </div>
                @endif
                @endif
            </div>
        </x-slot>

        <x-slot name="buttons">
            <div wire:loading>Searching users...</div>
        </x-slot>
    </x-modal>
</div>
