<x-ap-layout>
    <x-breadcrumb title="Masjid Baru" page="Masjid" active="Masjid Baru" route="{{ route('masjid.index') }}"
        back="true" />

    <div
        class="m-4 max-w-lg rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 2xl:col-span-2">
        <form action="{{ route('masjid.store') }}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="mb-4">
                <x-input-label class="mb-2" for="nama">Nama <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="nama" type="text" name="nama" :value="old('nama')" required />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="takmir">Takmir <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="takmir" type="text" name="takmir" :value="old('takmir')" required />
                <x-input-error :messages="$errors->get('takmir')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="dukuh">Dukuh <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="dukuh" type="text" name="dukuh" :value="old('dukuh')" required />
                <x-input-error :messages="$errors->get('dukuh')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="rt">RT <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="rt" type="text" name="rt" :value="old('rt')" required />
                <x-input-error :messages="$errors->get('rt')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="rw">RW <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="rw" type="text" name="rw" :value="old('rw')" required />
                <x-input-error :messages="$errors->get('rw')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="desa">Desa <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="desa" type="text" name="desa" :value="old('desa')" required />
                <x-input-error :messages="$errors->get('desa')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="kecamatan">Kecamatan <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="kecamatan" type="text" name="kecamatan" :value="old('kecamatan')" required />
                <x-input-error :messages="$errors->get('kecamatan')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="kab_kota">Kabupaten <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="kab_kota" type="text" name="kab_kota" :value="old('kab_kota')" required />
                <x-input-error :messages="$errors->get('kab_kota')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="kode_pos">Kode Pos <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="kode_pos" type="text" name="kode_pos" :value="old('kode_pos')" required />
                <x-input-error :messages="$errors->get('kode_pos')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="alamat">Alamat Lengkap <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="alamat" type="text" name="alamat" :value="old('alamat')" required />
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="cp_nama">C. P. Nama <span class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="cp_nama" type="text" name="cp_nama" :value="old('cp_nama')" required />
                <x-input-error :messages="$errors->get('cp_nama')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label class="mb-2" for="cp_telp">C. P. No. Telp./WA <span
                        class="text-sm text-red-600">*</span>
                </x-input-label>
                <x-text-input id="cp_telp" type="text" name="cp_telp" placeholder="08..." :value="old('cp_telp')"
                    required />
                <x-input-error :messages="$errors->get('cp_telp')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label class="mb-2" for="cap">Cap</x-input-label>
                <input
                    class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400"
                    type="file" name="cap" id="cap" />
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="cap_help">
                    PNG tanpa background (MAX. 2MB)
                </p>

                <x-input-error :messages="$errors->get('cap')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label class="mb-2" for="ttd">Ttd. Takmir</x-input-label>
                <input
                    class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400"
                    type="file" name="ttd" id="ttd" />
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="ttd_help">
                    PNG tanpa background (MAX. 2MB)
                </p>

                <x-input-error :messages="$errors->get('ttd')" class="mt-2" />
            </div>

            <div class="mb-7">
                <x-input-label class="mb-2" for="is_active" :value="__('Status')" />
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input checked type="radio" id="aktif" name="is_active" value="1"
                            class="peer hidden" required />
                        <label for="aktif"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Aktif</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="tidak_aktif" name="is_active" value="0"
                            class="peer hidden" />
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
