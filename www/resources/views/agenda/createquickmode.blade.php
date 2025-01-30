<x-ap-layout>
    <x-breadcrumb title="Quick Mode Agenda Baru" page="Agenda Management" active="Quick Mode Agenda Baru"
        route="{{ route('agenda.index') }}" back="true" />

    <div
        class="m-4 max-w-lg rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 2xl:col-span-2">
        <form action="{{ route('agenda.store.quick.mode') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-input-label class="mb-2" for="tgl_start">Awal Ramadhan <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <x-text-input id="tgl_start" type="date" name="tgl_start" :value="old('tgl_start')" required />
                <x-input-error :messages="$errors->get('tgl_start')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label class="mb-2" for="tgl_end">Akhir Ramadhan <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <x-text-input id="tgl_end" type="date" name="tgl_end" :value="old('tgl_end')" required />
                <x-input-error :messages="$errors->get('tgl_end')" class="mt-2" />
            </div>

            <!-- Tombol Simpan -->
            <div class="sm:col-full col-span-6 flex items-center">
                <button
                    class="rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    type="submit">
                    Simpan
                </button>
            </div>
        </form>

        <div id="alert-additional-content-5 mt-4"
            class="p-4 border border-gray-300 rounded-lg bg-gray-50 dark:border-gray-600 dark:bg-gray-800 mt-5"
            role="alert">
            <div class="flex items-center">
                <svg class="shrink-0 w-4 h-4 me-2 dark:text-gray-300" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">Informasi</h3>
            </div>
            <div class="mt-2 mb-4 text-sm text-gray-800 dark:text-gray-300">
                <p class="mb-4">Dengan memasukkan tanggal awal dan tanggal akhir ramdhan, sistem akan membuatkan
                    agenda untuk takjil dan kultum dari awal hingga akhir sesuai tanggal yang diinputkan sudah include
                    malam
                    takbir pada tanggal terakhir ramadhan dengan default waktu jam 20:00.
                </p>
                <p>Pastikan <i>range</i> tanggal yang diinput belum terdaftar di sistem, karena akan dilakukan
                    pengecekan duplikasi tanggal saat <i>generate</i> data.</p>
                <div class="flex mt-5">
                    <button type="button"
                        class="text-gray-800 bg-transparent border border-gray-700 hover:bg-gray-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-gray-800 dark:text-gray-300 dark:hover:text-white"
                        data-dismiss-target="#alert-additional-content-5" aria-label="Close">
                        Dismiss
                    </button>
                </div>
            </div>
        </div>

</x-ap-layout>
