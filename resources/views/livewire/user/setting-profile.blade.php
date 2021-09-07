<div>
    <form wire:submit.prevent="update">
        <!-- Profile section -->
        <div class="py-6 px-4 sm:p-6 lg:pb-8">
            <div>
                <h2 class="text-lg leading-6 font-medium text-gray-900">Profile</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Informasi umum pengguna
                </p>
            </div>

            <div class="mt-6 flex flex-col lg:flex-row">
                <div class="flex-grow space-y-6">
                    <x-input-addon label="Username" addon="apps.nfbs.or.id/" name="username" livewire />
                    <x-textarea label="Bio" name="bio" livewire />
                </div>

                <div class="mt-6 flex-grow lg:mt-0 lg:ml-6 lg:flex-grow-0 lg:flex-shrink-0">
                    <p class="text-sm font-medium text-gray-700" aria-hidden="true">
                        Photo
                    </p>
                    <div class="mt-1 lg:hidden">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 inline-block rounded-full overflow-hidden h-12 w-12"
                                aria-hidden="true">
                                <img class="rounded-full h-full w-full" src="{{ asset('images/user.png') }}" alt="">
                            </div>
                            <div class="ml-5 rounded-md shadow-sm">
                                <div
                                    class="group relative border border-gray-300 rounded-md py-2 px-3 flex items-center justify-center hover:bg-gray-50 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-sky-500">
                                    <label for="user-photo"
                                        class="relative text-sm leading-4 font-medium text-gray-700 pointer-events-none">
                                        <span>Change</span>
                                        <span class="sr-only"> user photo</span>
                                    </label>
                                    <input id="user-photo" name="user-photo" type="file"
                                        class="absolute w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hidden relative rounded-full shadow overflow-hidden lg:block">
                        <img class="relative rounded-full w-40 h-40" src="{{ asset('images/user.png') }}" alt="">
                        <label for="user-photo"
                            class="absolute inset-0 w-full h-full bg-black bg-opacity-75 flex items-center justify-center text-sm font-medium text-white opacity-0 hover:opacity-100 focus-within:opacity-100">
                            <span>Change</span>
                            <span class="sr-only"> user photo</span>
                            <input type="file" id="user-photo" name="user-photo"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md">
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <x-input label="Nama Lengkap" name="name" livewire />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    @php
                    $list = [
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan'
                    ]
                    @endphp
                    <x-select label="Jenis Kelamin" name="gender" :list="$list" livewire />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-input label="Email" name="email" livewire />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-input label="Tempat Lahir" name="birth_place" livewire />
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <x-date-picker id="datepicker" label="Tanggal Lahir" name="birth_date" livewire />
                </div>
            </div>
        </div>

        <!-- Privacy section -->
        {{-- <div class="pt-6 divide-y divide-gray-200">
            <div class="px-4 sm:px-6">
                <div>
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Privacy</h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Ornare eu a volutpat eget vulputate. Fringilla commodo amet.
                    </p>
                </div>
                <ul class="mt-2 divide-y divide-gray-200">
                    <li class="py-4 flex items-center justify-between">
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-900" id="privacy-option-1-label">
                                Available to hire
                            </p>
                            <p class="text-sm text-gray-500" id="privacy-option-1-description">
                                Nulla amet tempus sit accumsan. Aliquet turpis sed sit lacinia.
                            </p>
                        </div>
                        <!-- Enabled: "bg-teal-500", Not Enabled: "bg-gray-200" -->
                        <button type="button"
                            class="bg-gray-200 ml-4 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"
                            role="switch" aria-checked="true" aria-labelledby="privacy-option-1-label"
                            aria-describedby="privacy-option-1-description">
                            <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                            <span aria-hidden="true"
                                class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                        </button>
                    </li>
                    <li class="py-4 flex items-center justify-between">
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-900" id="privacy-option-2-label">
                                Make account private
                            </p>
                            <p class="text-sm text-gray-500" id="privacy-option-2-description">
                                Pharetra morbi dui mi mattis tellus sollicitudin cursus pharetra.
                            </p>
                        </div>
                        <!-- Enabled: "bg-teal-500", Not Enabled: "bg-gray-200" -->
                        <button type="button"
                            class="bg-gray-200 ml-4 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"
                            role="switch" aria-checked="false" aria-labelledby="privacy-option-2-label"
                            aria-describedby="privacy-option-2-description">
                            <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                            <span aria-hidden="true"
                                class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                        </button>
                    </li>
                    <li class="py-4 flex items-center justify-between">
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-900" id="privacy-option-3-label">
                                Allow commenting
                            </p>
                            <p class="text-sm text-gray-500" id="privacy-option-3-description">
                                Integer amet, nunc hendrerit adipiscing nam. Elementum ame
                            </p>
                        </div>
                        <!-- Enabled: "bg-teal-500", Not Enabled: "bg-gray-200" -->
                        <button type="button"
                            class="bg-gray-200 ml-4 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"
                            role="switch" aria-checked="true" aria-labelledby="privacy-option-3-label"
                            aria-describedby="privacy-option-3-description">
                            <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                            <span aria-hidden="true"
                                class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                        </button>
                    </li>
                    <li class="py-4 flex items-center justify-between">
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-gray-900" id="privacy-option-4-label">
                                Allow mentions
                            </p>
                            <p class="text-sm text-gray-500" id="privacy-option-4-description">
                                Adipiscing est venenatis enim molestie commodo eu gravid
                            </p>
                        </div>
                        <!-- Enabled: "bg-teal-500", Not Enabled: "bg-gray-200" -->
                        <button type="button"
                            class="bg-gray-200 ml-4 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"
                            role="switch" aria-checked="true" aria-labelledby="privacy-option-4-label"
                            aria-describedby="privacy-option-4-description">
                            <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                            <span aria-hidden="true"
                                class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="mt-4 py-4 px-4 flex justify-end sm:px-6">
                <button type="button"
                    class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    Cancel
                </button>
                <button type="submit"
                    class="ml-5 bg-sky-700 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    Save
                </button>
            </div>
        </div> --}}

        <div class="py-6 px-4 float-right">
            <button
                class="flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700">Simpan</button>
        </div>
    </form>
</div>
