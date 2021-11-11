<div>
    <div class="flow-root p-4">
        <div class="mb-4 font-semibold">
            {{ $user['name'] }}
        </div>
        <ul role="list" class="-my-5 divide-y divide-gray-200">
            @foreach ($qna as $item)
            <li class="py-5">
                <div class="relative focus-within:ring-2 focus-within:ring-indigo-500">
                    <h3 class="text-sm font-semibold text-gray-800">
                        <a href="#" class="hover:underline focus:outline-none">
                            <!-- Extend touch target to entire panel -->
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            Q: {{ $item['question'] }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 line-clamp-2">
                        A: {{ $item['answer'] }}
                    </p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
