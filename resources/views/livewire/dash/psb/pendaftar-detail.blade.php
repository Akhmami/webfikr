<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Informasi {{ $user->name }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Informasi personal, orang tua dan tagihan PSB
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nama Lengkap
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Email
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->email }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tempat, Tanggal Lahir
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->birth_place .', '. tanggal($user->birth_date) }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tagihan PSB
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if ($user->billerPsb->count() > 0)
                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            <li class="p-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <span class="flex-1 w-0 truncate">
                                        VA: {{ $user->billerPsb->billing->full_virtual_account ?? null }}
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <span class="font-medium text-indigo-600">
                                        {{ rupiah($user->billerPsb->billing->trx_amount ?? 0) }}
                                    </span>
                                </div>
                            </li>
                        </ul>
                        @else
                        <span>Tagihan PSB tidak tersedia</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
