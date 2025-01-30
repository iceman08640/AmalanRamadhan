<x-ap-layout>
    <x-breadcrumb title="{{ $masjid->nama }}" page="Masjid Management" active="{{ $masjid->nama }}"
        route="{{ route('masjid.index') }}" back="true" />

    @if (session('status'))
        <x-alert value="{{ session('status') }}" tipe="{{ session('tipe') }}" class="max-w-full" />
    @endif

    <div
        class="m-4 grid grid-cols-[2fr,1fr] items-start rounded-lg border border-gray-200 bg-white p-4 text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
        <!-- Section 1 -->
        <div class="ml-4 mr-6">
            <form action="{{ route('masjid.update', $masjid->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                {{-- @method("PUT") --}}

                <div class="mb-4">
                    <x-input-label class="mb-2" for="nama">Nama <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="nama" type="text" name="nama" :value="old('nama', $masjid->nama)" required />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="takmir">Takmir <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="takmir" type="text" name="takmir" :value="old('takmir', $masjid->takmir)" required />
                    <x-input-error :messages="$errors->get('takmir')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="dukuh">Dukuh <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="dukuh" type="text" name="dukuh" :value="old('dukuh', $masjid->dukuh)" required />
                    <x-input-error :messages="$errors->get('dukuh')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="rt">RT <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="rt" type="text" name="rt" :value="old('rt', $masjid->rt)" required />
                    <x-input-error :messages="$errors->get('rt')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="rw">RW <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="rw" type="text" name="rw" :value="old('rw', $masjid->rw)" required />
                    <x-input-error :messages="$errors->get('rw')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="desa">Desa <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="desa" type="text" name="desa" :value="old('desa', $masjid->desa)" required />
                    <x-input-error :messages="$errors->get('desa')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="kecamatan">Kecamatan <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="kecamatan" type="text" name="kecamatan" :value="old('kecamatan', $masjid->kecamatan)" required />
                    <x-input-error :messages="$errors->get('kecamatan')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="kab_kota">Kabupaten <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="kab_kota" type="text" name="kab_kota" :value="old('kab_kota', $masjid->kab_kota)" required />
                    <x-input-error :messages="$errors->get('kab_kota')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="kode_pos">Kode Pos <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="kode_pos" type="text" name="kode_pos" :value="old('kode_pos', $masjid->kode_pos)" required />
                    <x-input-error :messages="$errors->get('kode_pos')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="alamat">Alamat Lengkap <span
                            class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="alamat" type="text" name="alamat" :value="old('alamat', $masjid->alamat)" required />
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="cp_nama">C. P. Nama <span class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="cp_nama" type="text" name="cp_nama" :value="old('cp_nama', $masjid->cp_nama)" required />
                    <x-input-error :messages="$errors->get('cp_nama')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label class="mb-2" for="cp_telp">C. P. No. Telp./WA <span
                            class="text-sm text-red-600">*</span>
                    </x-input-label>
                    <x-text-input id="cp_telp" type="text" name="cp_telp" placeholder="08..."
                        :value="old('cp_telp', $masjid->cp_telp)" required />
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

                <button
                    class="mt-2 rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    type="submit">
                    Simpan
                </button>
            </form>
        </div>
        <!-- End of Section 1 -->

        <!-- Section 2 -->
        <div class="space-y-4">
            <!-- Cap -->
            <div class="rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
                <p class="mb-3 p-4 font-normal text-gray-700 dark:text-gray-400 text-center h5">Cap</p>
                @if ($masjid->cap_aset_id !== null)
                    <img class="w-full rounded-b-lg object-cover" src="{{ route('aset.show', $masjid->cap_aset_id) }}"
                        alt="Cap {{ $masjid->nama }}" />
                @else
                    <img class="w-full rounded-b-lg object-cover" src="{{ asset('img/logo/default.jpg') }}"
                        alt="Cap {{ $masjid->nama }}" />
                @endif
            </div>

            <!-- TTD -->
            <div class="rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
                <p class="mb-3 p-4 font-normal text-gray-700 dark:text-gray-400 text-center h5">Ttd.</p>
                @if ($masjid->ttd_aset_id !== null)
                    <img class="w-full rounded-b-lg object-cover"
                        src="{{ route('aset.show', $masjid->ttd_aset_id) }}" alt="Ttd. {{ $masjid->nama }}" />
                @else
                    <img class="w-full rounded-b-lg object-cover" src="{{ asset('img/logo/default.jpg') }}"
                        alt="Ttd. {{ $masjid->nama }}" />
                @endif
            </div>
        </div>
        <!-- End of Section 2 -->
    </div>
</x-ap-layout>
