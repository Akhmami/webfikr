<div>
    <div x-data="{ tab: window.location.hash ? window.location.hash : '#tab1' }">
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select a tab</label>
            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
            <select id="tabs" name="tabs"
                class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                @foreach ($status_psb as $item)
                <option>{{ $item->status }}</option>
                @endforeach
            </select>
        </div>
        <div class="hidden sm:block">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex" aria-label="Tabs">
                    <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                    @foreach ($status_psb as $item)
                    <a href="#" x-on:click.prevent="tab='#tab{{ $item->id }}'"
                        :class="{ 'border-indigo-500 text-indigo-600' : tab === '#tab{{$item->id}}' }"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        {{ $item->status }}
                    </a>
                    @endforeach
                </nav>
            </div>
        </div>
        @foreach ($status_psb as $item)
        <div x-show="tab == '#tab{{$item->id}}'" class="p-8" x-cloak>
            <div class="flex mb-4">
                <a href="{{ route('dash.psb.status-psb-edit', $item->id) }}" title="edit"
                    class="flex items-center group px-4 py-2 border border-transparent rounded-xl shadow-sm text-white bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                    <!-- Heroicon name: solid/edit-alt -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Edit</span>
                </a>
            </div>
            <div class="prose lg:prose-xl">{!! $item->description !!}</div>
        </div>
        @endforeach
    </div>
</div>
