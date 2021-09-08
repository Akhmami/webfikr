<div>
    <div class="px-4 sm:px-6 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">No. pendaftaran</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->no_pendaftaran }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Email address</dt>
            <dd class="mt-1 text-sm text-gray-900">
                <div class="flex space-x-2 items-center">
                    <div>{{ $user->email }}</div>
                    <a href="#"
                        onclick="Livewire.emit('openModal', 'dash.edit-value', {{ json_encode(['model' => 'User', 'id' => $user->id, 'column' => 'email']) }})"
                        class="p-1 rounded-md hover:bg-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hover:text-gray-900"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>
                </div>
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
            <dd class="mt-1 text-sm text-gray-900">
                <div class="flex space-x-2 items-center">
                    <div>{{ $user->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                    <a href="#"
                        onclick="Livewire.emit('openModal', 'dash.edit-value', {{ json_encode(['model' => 'User', 'id' => $user->id, 'column' => 'gender', 'type' => 'jk']) }})"
                        class="p-1 rounded-md hover:bg-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hover:text-gray-900"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>
                </div>
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Status</dt>
            <dd class="mt-1 text-sm text-gray-900">
                <x-badge color="green" text="santri" />
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Tempat, tanggal lahir</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->tempat_tanggal_lahir }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Phone</dt>
            <dd class="mt-1 text-sm text-gray-900">
                @foreach ($user->mobilePhones as $phone)
                <div class="flex space-x-2 items-center">
                    <div><strong>{{ $phone->full_number }}</strong> ({{ $phone->name }})</div>
                    <a href="#"
                        onclick="Livewire.emit('openModal', 'user.setting-edit-phone', {{ json_encode(['phone' => $phone->id ]) }})"
                        class="p-1 rounded-md hover:bg-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hover:text-gray-900"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>
                </div>
                @endforeach
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">NIK</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->nik }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">NIS // NISN</dt>
            <dd class="mt-1 text-sm text-gray-900">
                <div class="flex space-x-2 items-center">
                    <div class="flex items-center">
                        {{ $user->userDetail->nis ?? '-' }}
                        <a href="#"
                            onclick="Livewire.emit('openModal', 'dash.edit-value', {{ json_encode(['model' => 'UserDetail', 'id' => $user->userDetail->id, 'column' => 'nis']) }})"
                            class="p-1 rounded-md hover:bg-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hover:text-gray-900"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                    </div>
                    <div> // </div>
                    <div class="flex items-center">
                        {{ $user->userDetail->nisn }}
                        <a href="#"
                            onclick="Livewire.emit('openModal', 'dash.edit-value', {{ json_encode(['model' => 'UserDetail', 'id' => $user->userDetail->id, 'column' => 'nisn']) }})"
                            class="p-1 rounded-md hover:bg-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hover:text-gray-900"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Jenjang</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->jenjang }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Angkatan</dt>
            <dd class="mt-1 text-sm text-gray-900">
                <div class="flex space-x-2 items-center">
                    <div>{{ $user->userDetail->angkatan }}</div>
                    <a href="#"
                        onclick="Livewire.emit('openModal', 'dash.edit-value', {{ json_encode(['model' => 'UserDetail', 'id' => $user->userDetail->id, 'column' => 'angkatan']) }})"
                        class="p-1 rounded-md hover:bg-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 hover:text-gray-900"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>
                </div>
            </dd>
        </div>
        <!--
                                        Untuk PSB
                                        Jurusan pilihan
                                        Jenis Pendaftaran
                                        ISI DISINI!

                                        -->
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Jurusan</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->jurusan }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">NPSN // Asal sekolah</dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ $user->userDetail->npsn }} // {{ $user->userDetail->asal_sekolah }}
            </dd>
        </div>
        <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500">Alamat asal sekolah</dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ $user->userDetail->alamat_asal_sekolah }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">HP asal sekolah</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->hp_asal_sekolah }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Negara</dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ $user->userDetail->neagara }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Anak ke</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->anak_ke }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Jumlah saudara</dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ $user->userDetail->jml_saudara }}
            </dd>
        </div>
        <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500">Attachments</dt>
            <dd class="mt-1 text-sm text-gray-900">
                <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                        <div class="w-0 flex-1 flex items-center">
                            <!-- Heroicon name: solid/paper-clip -->
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 flex-1 w-0 truncate">
                                resume_front_end_developer.pdf
                            </span>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Download </a>
                        </div>
                    </li>

                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                        <div class="w-0 flex-1 flex items-center">
                            <!-- Heroicon name: solid/paper-clip -->
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 flex-1 w-0 truncate">
                                coverletter_front_end_developer.pdf </span>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Download </a>
                        </div>
                    </li>
                </ul>
            </dd>
        </div>
    </div>
</div>
