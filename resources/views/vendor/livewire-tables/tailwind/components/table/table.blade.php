<div class="align-middle max-w-full shadow rounded-none md:rounded-lg">
    <table {{ $attributes->except('wire:sortable') }} class="w-full divide-y divide-gray-200">
        <thead>
            <tr>
                {{ $head }}
            </tr>
        </thead>

        <tbody {{ $attributes->only('wire:sortable') }} class="bg-white divide-y divide-gray-200">
            {{ $body }}
        </tbody>
    </table>
</div>
