<x-ap-layout>
    <x-breadcrumb title="Ustadz Baru" page="Ustadz" active="Ustadz Baru" route="{{ route('ustadz.index') }}"
        back="true" />

    <div
        class="m-4 max-w-lg rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 2xl:col-span-2">
        <form action="{{ route('ustadz.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-input-label class="mb-2" for="nama">Nama <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="nama" type="text" name="nama" :value="old('nama')" required />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="alamat">Alamat</x-input-label>
                <x-text-input id="alamat" type="text" name="alamat" :value="old('alamat')" />
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="url_maps">URL Google Maps</x-input-label>
                <x-text-input id="url_maps" type="text" name="url_maps" :value="old('url_maps')" />
                <x-input-error :messages="$errors->get('url_maps')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="no_telp">Telp/WA</x-input-label>
                <x-text-input id="no_telp" type="text" name="no_telp" placeholder="08..." :value="old('no_telp')" />
                <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
            </div>
            <div class="mb-7">
                <x-input-label class="mb-2" for="is_active" :value="__('Status')" />
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input checked type="radio" id="aktif" name="is_active" value="1" class="peer hidden"
                            required />
                        <label for="aktif"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Aktif</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="tidak_aktif" name="is_active" value="0" class="peer hidden" />
                        <label for="tidak_aktif"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-s-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">
                                Tidak Aktif
                            </div>
                        </label>
                    </li>
                </ul>
                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
            </div>

            <div class="sm:col-full col-span-6 flex items-center">
                <button
                    class="rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    type="submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-ap-layout>
