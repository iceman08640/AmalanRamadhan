<x-ap-layout>
    <x-breadcrumb title="Agenda Baru" page="Agenda Management" active="Agenda Baru" route="{{ route('agenda.index') }}"
        back="true" />

    <div
        class="m-4 max-w-lg rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 2xl:col-span-2">
        <form action="{{ route('agenda.store') }}" method="POST" x-data="{ isTakjil: false, isMalamTakbir: false }">
            @csrf

            <!-- Input Tanggal -->
            <div class="mb-4">
                <x-input-label class="mb-2" for="tgl">Tanggal <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <x-text-input id="tgl" type="date" name="tgl" :value="old('tgl')" required />
                <x-input-error :messages="$errors->get('tgl')" class="mt-2" />
            </div>

            <!-- Input Agenda Kultum -->
            <div class="mb-4">
                <x-input-label class="mb-2" for="is_kultum" :value="__('Agenda Kultum')" />
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input type="radio" id="is_kultum_true" name="is_kultum" value="1" class="peer hidden"
                            required />
                        <label for="is_kultum_true"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Ya</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="is_kultum_false" name="is_kultum" value="0"
                            class="peer hidden" />
                        <label for="is_kultum_false"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-s-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Tidak</div>
                        </label>
                    </li>
                </ul>
                <x-input-error :messages="$errors->get('is_kultum')" class="mt-2" />
            </div>

            <!-- Input Agenda Takjil -->
            <div class="mb-4">
                <x-input-label class="mb-2" for="is_takjil" :value="__('Agenda Takjil')" />
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input type="radio" id="is_takjil_true" name="is_takjil" value="1" class="peer hidden"
                            required x-model="isTakjil" />
                        <label for="is_takjil_true"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Ya</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="is_takjil_false" name="is_takjil" value="0" class="peer hidden"
                            x-model="isTakjil" />
                        <label for="is_takjil_false"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-s-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Tidak</div>
                        </label>
                    </li>
                </ul>
                <x-input-error :messages="$errors->get('is_takjil')" class="mt-2" />
            </div>

            <!-- Input Malam Takbir -->
            <div class="mb-4" x-show="isTakjil">
                <x-input-label class="mb-2" for="is_malam_takbir" :value="__('Malam Takbir')" />
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input type="radio" id="is_malam_takbir_true" name="is_malam_takbir" value="1"
                            class="peer hidden" x-model="isMalamTakbir" />
                        <label for="is_malam_takbir_true"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Ya</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="is_malam_takbir_false" name="is_malam_takbir" value="0"
                            class="peer hidden" x-model="isMalamTakbir" />
                        <label for="is_malam_takbir_false"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-s-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Tidak</div>
                        </label>
                    </li>
                </ul>
                <x-input-error :messages="$errors->get('is_malam_takbir')" class="mt-2" />
            </div>

            <!-- Input Waktu -->
            <div class="mb-4" x-show="isMalamTakbir">
                <x-input-label class="mb-2" for="waktu" :value="__('Waktu')" />
                <input type="time" id="waktu" name="waktu" x-bind:disabled="!isMalamTakbir"
                    x-bind:required="isMalamTakbir"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const waktuInput = document.getElementById('waktu');

            if (waktuInput) {
                // Memastikan format 24 jam
                waktuInput.addEventListener('change', function() {
                    const waktu = this.value;
                    const [jam, menit] = waktu.split(':');

                    // Jika jam kurang dari 10, tambahkan leading zero
                    if (jam < 10) {
                        this.value = `0${jam}:${menit}`;
                    }
                });

                // Memastikan input waktu selalu dalam format 24 jam saat halaman dimuat
                if (waktuInput.value) {
                    const [jam, menit] = waktuInput.value.split(':');
                    if (jam < 10) {
                        waktuInput.value = `0${jam}:${menit}`;
                    }
                }
            }
        });
    </script>

</x-ap-layout>
