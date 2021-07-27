<div>
    <form wire:submit.prevent="change">
        <!-- Profile section -->
        <div class="py-6 px-4 sm:p-6 lg:pb-8">
            <div>
                <h2 class="text-lg leading-6 font-medium text-gray-900">Change Password</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Ubah kata sandi anda kapan saja.
                </p>
            </div>

            <div class="mt-6 grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <x-input label="Kata Sandi Saat Ini" type="password" name="old_password" livewire />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-input label="Kata Sandi Baru" type="password" name="password" livewire />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-input label="Konfirmasi Kata Sandi" type="password" name="password_confirmation" livewire />
                </div>
            </div>
        </div>

        <div class="py-6 px-4 float-right">
            <button
                class="flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700">Simpan</button>
        </div>
    </form>
</div>
