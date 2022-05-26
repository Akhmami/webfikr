<aside class="py-6 lg:col-span-3">
    <nav class="space-y-1">
        <!-- Current: "bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700", Default: "border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900" -->
        <a href="#" x-on:click.prevent="tab='#profile'"
            :class="{ 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : tab === '#profile' }"
            class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium"
            aria-current="page">
            <!--
                      Heroicon name: outline/user-circle

                      Current: "text-teal-500 group-hover:text-teal-500", Default: "text-gray-400 group-hover:text-gray-500"
                    -->
            <svg :class="{ 'text-blue-500 group-hover:text-blue-500' : tab === '#profile' }"
                class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="truncate">
                Profile
            </span>
        </a>

        <a href="#" x-on:click.prevent="tab='#change-password'"
            :class="{ 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : tab === '#change-password' }"
            class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
            <!-- Heroicon name: outline/key -->
            <svg :class="{ 'text-blue-500 group-hover:text-blue-500' : tab === '#change-password' }"
                class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
            <span class="truncate">
                Change Password
            </span>
        </a>

        <a href="#" x-on:click.prevent="tab='#mobile-phones'"
            :class="{ 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : tab === '#mobile-phones' }"
            class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
            <!-- Heroicon name: outline/device-mobile -->
            <svg :class="{ 'text-blue-500 group-hover:text-blue-500' : tab === '#mobile-phones' }"
                class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            <span class="truncate">
                Mobile Phones
            </span>
        </a>

        <a href="#" x-on:click.prevent="tab='#notifications'"
            :class="{ 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : tab === '#notifications' }"
            class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
            <!-- Heroicon name: outline/bell -->
            <svg :class="{ 'text-blue-500 group-hover:text-blue-500' : tab === '#notifications' }"
                class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="truncate">
                Notifications
            </span>
        </a>

        <a href="#"
            class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
            <!-- Heroicon name: outline/view-grid-add -->
            <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>
            <span class="truncate">
                Integrations
            </span>
        </a>
    </nav>
</aside>
