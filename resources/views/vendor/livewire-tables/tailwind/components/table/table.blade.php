<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="align-middle overflow-hidden shadow rounded-none md:rounded-lg">
            <table {{ $attributes->except('wire:sortable') }} class="min-w-full divide-y divide-gray-200">
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
    </div>
</div>
