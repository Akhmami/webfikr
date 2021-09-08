<div>
    <div class="px-4 sm:px-6 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Nama ayah</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->nama_ayah }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Tanggal lahir</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->tahun_lahir_ayah }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Pendidikan</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->pendidikan_ayah }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Pekerjaan</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->pekerjaan_ayah }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Tempat kerja</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->tempat_kerja_ayah }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Penghasilan</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->penghasilan_ayah }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Pendidikan agama</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->pendidikan_agama_ayah }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Bacaan Quran</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->userDetail->baca_quran_ayah }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Haji dan Umroh</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->haji_umroh_ayah }}</dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Organisasi</dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ $user->userDetail->organisasi_islam_ayah }}
            </dd>
        </div>
    </div>
</div>
