<x-ap-layout>
    <x-breadcrumb title="{{ substr(strip_tags($catatan_surat->konten), 0, 20) }}" page="Catatan Surat"
        active="{{ substr(strip_tags($catatan_surat->konten), 0, 10) }}"
        route="{{ route('catatan-surat.index', $masjid->id) }}" back="true" />

    @if (session('status'))
        <x-alert value="{{ session('status') }}" tipe="{{ session('tipe') }}" class="max-w-lg" />
    @endif

    <div
        class="m-4 max-w-lg rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 2xl:col-span-2">
        <form action="{{ route('catatan-surat.update', [$masjid->id, $catatan_surat->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-7">
                <x-input-label class="mb-2" for="nama">Tipe Agenda <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input @checked($catatan_surat->tipe === 'takjil') type="radio" id="takjil" name="tipe" value="takjil"
                            class="peer hidden" required />
                        <label for="takjil"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Takjil</div>
                        </label>
                    </li>
                    <li>
                        <input @checked($catatan_surat->tipe === 'kultum') type="radio" id="kultum" name="tipe" value="kultum"
                            class="peer hidden" />
                        <label for="kultum"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-s-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">
                                Kultum
                            </div>
                        </label>
                    </li>
                </ul>
                <x-input-error :messages="$errors->get('tipe')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label class="mb-2" for="konten">Konten <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <textarea name="konten" id="konten" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ $catatan_surat->konten }}</textarea>
                <x-input-error :messages="$errors->get('konten')" class="mt-2" />
            </div>

            <div class="mb-7">
                <x-input-label class="mb-2" for="is_active" :value="__('Status')" />
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input @checked($catatan_surat->is_active) type="radio" id="aktif" name="is_active"
                            value="1" class="peer hidden" required />
                        <label for="aktif"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Aktif</div>
                        </label>
                    </li>
                    <li>
                        <input @checked(!$catatan_surat->is_active) type="radio" id="tidak_aktif" name="is_active"
                            value="0" class="peer hidden" />
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

    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('konten', {
            enterMode: Number(1),
            toolbarGroups: [{
                    name: 'basicstyles',
                    groups: ['basicstyles']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'blocks']
                }
            ]
        });
    </script>

</x-ap-layout>
