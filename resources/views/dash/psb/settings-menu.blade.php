<aside class="py-6 lg:col-span-2">
    <nav class="space-y-1">
        <a href="#" x-on:click.prevent="tab='#gelombang'"
            :class="{ 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : tab === '#gelombang' }"
            class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium"
            aria-current="page">
            <svg :class="{ 'text-blue-500 group-hover:text-blue-500' : tab === '#gelombang' }"
                class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span class="truncate">
                Gelombang
            </span>
        </a>
        <a href="#" x-on:click.prevent="tab='#internal'"
            :class="{ 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : tab === '#internal' }"
            class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium"
            aria-current="page">
            <svg :class="{ 'text-blue-500 group-hover:text-blue-500' : tab === '#internal' }"
                class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span class="truncate">
                Internal
            </span>
        </a>
        <a href="#" x-on:click.prevent="tab='#medical'"
            :class="{ 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : tab === '#medical' }"
            class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium"
            aria-current="page">
            <svg :class="{ 'text-blue-500 group-hover:text-blue-500' : tab === '#medical' }"
                class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span class="truncate">
                Medical Check
            </span>
        </a>
        <a href="#" x-on:click.prevent="tab='#questionnaire'"
            :class="{ 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : tab === '#questionnaire' }"
            class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium"
            aria-current="page">
            <svg :class="{ 'text-blue-500 group-hover:text-blue-500' : tab === '#questionnaire' }"
                class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span class="truncate">
                Questionnaire
            </span>
        </a>
    </nav>
</aside>
