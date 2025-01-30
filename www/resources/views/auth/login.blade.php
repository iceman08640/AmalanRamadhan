<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Grid Container -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 min-h-screen">
        <!-- Gambar Latar Belakang (Hanya Tampil di Desktop) -->
        <div class="hidden lg:block lg:col-span-2">
            <img src="{{ asset('img/static/masjid.png') }}" alt="Gambar latar belakang"
                class="object-cover w-full h-full opacity-50">
        </div>

        <!-- Form Login -->
        <div class="col-span-1 flex items-center justify-center p-6 lg:p-8">
            <div class="w-full max-w-md">
                <!-- Logo dan Nama Sistem -->
                <div class="mb-6 flex justify-center">
                    @if ($identitas && $identitas->aset_id !== null)
                        <img class="h-12 w-auto" src="{{ route('aset.show', $identitas->aset_id) }}"
                            alt="Logo {{ $identitas->nama_sistem }}" />
                    @endif
                    <span class="ms-2 self-center text-2xl font-semibold dark:text-white">
                        {{ $identitas ? $identitas->nama_sistem : 'Amalan Ramadhan' }}
                    </span>
                </div>

                <!-- Card Login -->
                <div class="w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                        Masuk ke Platform
                    </h2>

                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Username -->
                        <div>
                            <x-input-label for="username" :value="__('Username')" class="mb-2" />
                            <x-text-input id="username" type="text" name="username" :value="old('username')"
                                autocomplete="off" required autofocus />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="mb-2" />
                            <div class="relative" x-data="{ showPassword: false }">
                                <x-text-input id="password" type="password" name="password" required
                                    class="w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600"
                                    x-bind:type="showPassword ? 'text' : 'password'" />
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 flex items-center px-3">
                                    <i :class="showPassword ? 'ri-eye-off-line' : 'ri-eye-line'"
                                        class="text-gray-500 dark:text-gray-400"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Tombol Login -->
                        <x-primary-button class="w-full">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </form>
                </div>

                <!-- Toggle Dark Mode -->
                <div class="mt-6 text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <span class="dark:text-white">Switch Mode:</span>
                        <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button"
                            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-xs p-1">
                            <x-s-v-g-s.mode id="theme-toggle-dark-icon" />
                            <x-s-v-g-s.mode id="theme-toggle-light-icon" :dark="false" />
                        </button>
                    </div>
                    <div id="tooltip-toggle" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                        Toggle dark mode
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
