<div>
    <div class="font-medium text-gray-900">
        <a href="{{ route('dash.users.show', $user->id) }}"
            class="text-indigo-600 font-semibold hover:underline cursor-pointer">{{ $user->name }}</a>
    </div>
    <div class="flex items-center space-x-0.5 text-sm text-gray-500">
        <div>{{ $user->email }}</div>
        @if ($user->email_verified_at !== null)
        <div title="Verified">
            <!-- Heroicon name: outline/check-circle -->
            <svg class="h-4 w-4 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        @endif
    </div>
</div>
