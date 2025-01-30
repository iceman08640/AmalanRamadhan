<x-ap-layout>
    <x-breadcrumb title="Detail Agenda" page="Agenda Management" active="Detail Agenda" route="{{ route('agenda.index') }}"
        back="true" />

    @if (session('status'))
        <x-alert value="{{ session('status') }}" tipe="{{ session('tipe') }}" class="max-w-lg" />
    @endif

    <div
        class="m-4 max-w-lg rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 2xl:col-span-2">
        <!-- Form Edit -->
        <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" x-data="{ isTakjil: {{ $agenda->tipe === 'takjil' ? 'true' : 'false' }}, isMalamTakbir: {{ $agenda->is_takbiran ? 'true' : 'false' }} }">
            @csrf
            @method('PUT')

            <!-- Input Tanggal -->
            <div class="mb-4">
                <x-input-label class="mb-2" for="tgl">Tanggal <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <x-text-input id="tgl" type="date" name="tgl" :value="old('tgl', $agenda->tgl)" required />
                <x-input-error :messages="$errors->get('tgl')" class="mt-2" />
            </div>

            <!-- Tampilkan Tipe (Tidak Bisa Diubah) -->
            <div class="mb-4">
                <x-input-label class="mb-2">Tipe Agenda</x-input-label>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ $agenda->tipe === 'takjil' ? 'Takjil' : 'Kultum' }}
                </p>
            </div>

            <!-- Input Malam Takbir (Hanya Tampil jika Tipe = Takjil) -->
            <div class="mb-4" x-show="isTakjil">
                <x-input-label class="mb-2" for="is_malam_takbir">Malam Takbir</x-input-label>
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input type="radio" id="is_malam_takbir_true" name="is_malam_takbir" value="1"
                            class="peer hidden" x-model="isMalamTakbir" @checked($agenda->is_malam_takbir) />
                        <label for="is_malam_takbir_true"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Ya</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="is_malam_takbir_false" name="is_malam_takbir" value="0"
                            class="peer hidden" x-model="isMalamTakbir" @checked(!$agenda->is_malam_takbir) />
                        <label for="is_malam_takbir_false"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-s-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Tidak</div>
                        </label>
                    </li>
                </ul>
                <x-input-error :messages="$errors->get('is_malam_takbir')" class="mt-2" />
            </div>

            <!-- Input Waktu (Hanya Tampil jika Malam Takbir = Ya) -->
            <div class="mb-4" x-show="isMalamTakbir">
                <x-input-label class="mb-2" for="waktu">Waktu</x-input-label>
                <input type="time" id="waktu" name="waktu" x-bind:disabled="!isMalamTakbir"
                    x-bind:required="isMalamTakbir"
                    value="{{ old('waktu', $agenda->waktu ? substr($agenda->waktu, 0, 5) : '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>

            <div class="mb-7">
                <x-input-label class="mb-2" for="is_active" :value="__('Status')" />
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input @checked($agenda->is_active) type="radio" id="aktif" name="is_active"
                            value="1" class="peer hidden" required />
                        <label for="aktif"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Aktif</div>
                        </label>
                    </li>
                    <li>
                        <input @checked(!$agenda->is_active) type="radio" id="tidak_aktif" name="is_active"
                            value="0" class="peer hidden" />
                        <label for="tidak_aktif"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-s-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:text-white">
                            <div class="block w-full text-center">
                                Tidak Aktif
                            </div>
                        </label>
                    </li>
                </ul>
                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
            </div>


            <!-- Tombol Simpan -->
            <div class="sm:col-full col-span-6 flex items-center">
                <button type="submit"
                    class="rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Script untuk Format Waktu 24 Jam -->
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
