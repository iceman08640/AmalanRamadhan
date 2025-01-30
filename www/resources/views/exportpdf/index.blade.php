<x-ap-layout>
    <x-breadcrumb title="Export PDF" page="Export PDF" />

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert value="{{ $error }}" tipe="danger" />
        @endforeach
    @endif

    @if (session('status'))
        <x-alert value="{{ session('status') }}" tipe="{{ session('tipe') }}" />
    @endif

    <form action="{{ route('exportpdf.download') }}" method="POST">
        @csrf
        <div
            class="grid grid-cols-12 gap-6 p-4 m-4  bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">

            <div class="col-span-8">
                <x-input-label class="mb-2" for="mode">Mode <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <ul class="grid w-full md:grid-cols-3 gap-2">
                    <li>
                        <input type="radio" id="blangko_kosong" name="mode" value="blangko_kosong"
                            class="peer hidden" required />
                        <label for="blangko_kosong"
                            class="inline-flex w-full cursor-pointer items-center justify-center rounded-lg border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Blangko Kosong</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="lembar_permohonan" name="mode" value="lembar_permohonan"
                            class="peer hidden" required />
                        <label for="lembar_permohonan"
                            class="inline-flex w-full cursor-pointer items-center justify-center rounded-lg border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Lembar Permohonan</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="jadwal" name="mode" value="jadwal" class="peer hidden"
                            required />
                        <label for="jadwal"
                            class="inline-flex w-full cursor-pointer items-center justify-center rounded-lg border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Jadwal</div>
                        </label>
                    </li>
                </ul>
                <x-input-error :messages="$errors->get('mode')" class="mt-2" />
            </div>

            <div class="col-span-4">
                <x-input-label class="mb-2" for="search-tipe">Tipe <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <div x-data="{
                    search: '',
                    open: false,
                    initVal: '--Pilih--',
                    idVal: null,
                    items: [
                        { id: 'takjil', nama: 'Takjil' },
                        { id: 'kultum', nama: 'Imam dan Pembicara' }
                    ],
                
                    get filteredItems() {
                        return this.items.filter(i => i.nama.toLowerCase().includes(this.search.toLowerCase()));
                    },
                
                    handleClickOption(item) {
                        this.idVal = item.id;
                        this.search = item.nama;
                        this.open = false;
                    },
                
                    resetIdVal() {
                        if (this.search === '') {
                            this.idVal = null;
                        }
                    }
                }" class="relative w-full">
                    <input type="search" id="search-tipe" x-model="search" x-on:click="open = !open"
                        x-on:input="resetIdVal"
                        class="block w-full border border-gray-400 px-3 py-2 rounded dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                        required>
                    <span class="absolute top-0 start-0 h-full p-3 text-sm font-medium rounded-e-lg"
                        :class="search.length === 0 ? 'text-gray-400 dark:text-gray-400' : 'text-gray-900 dark:text-white'"
                        x-text="search.length === 0 ? initVal : ''">
                    </span>
                    <span x-show="search.length < 1"
                        class="absolute top-0 end-0 h-full p-2 text-sm font-medium rounded-e-lg">
                        <x-remix-icon class="ri-arrow-down-s-line text-gray-600 dark:text-gray-400 text-xl" />
                    </span>
                    <ul x-show="open" x-on:click.outside="open = false"
                        class="absolute z-50 w-full bg-white border border-gray-300 max-h-40 overflow-y-auto dark:bg-gray-700 dark:border-gray-600">
                        <template x-for="item in filteredItems" :key="item.id">
                            <li x-on:click="handleClickOption(item)"
                                class="px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer dark:text-white"
                                x-text="item.nama"></li>
                        </template>
                    </ul>
                    <input type="hidden" name="tipe" x-model="idVal">
                </div>
            </div>

            <div class="col-span-4">
                <x-input-label class="mb-2" for="search-masjid">Masjid <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <div x-data="{
                    search: '',
                    open: false,
                    initVal: '--Pilih--',
                    idVal: null,
                    items: {{ json_encode($list_masjid) }},
                
                    get filteredItems() {
                        return this.items.filter(i => i.nama.toLowerCase().includes(this.search.toLowerCase()));
                    },
                
                    handleClickOption(item) {
                        this.idVal = item.id;
                        this.search = item.nama;
                        this.open = false;
                    },
                
                    resetIdVal() {
                        if (this.search === '') {
                            this.idVal = null;
                        }
                    }
                }" class="relative w-full">
                    <input type="search" id="search-masjid" x-model="search" x-on:click="open = !open"
                        x-on:input="resetIdVal"
                        class="block w-full border border-gray-400 px-3 py-2 rounded dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                        required>
                    <span class="absolute top-0 start-0 h-full p-3 text-sm font-medium rounded-e-lg"
                        :class="search.length === 0 ? 'text-gray-400 dark:text-gray-400' : 'text-gray-900 dark:text-white'"
                        x-text="search.length === 0 ? initVal : ''">
                    </span>
                    <span x-show="search.length < 1"
                        class="absolute top-0 end-0 h-full p-2 text-sm font-medium rounded-e-lg">
                        <x-remix-icon class="ri-arrow-down-s-line text-gray-600 dark:text-gray-400 text-xl" />
                    </span>
                    <ul x-show="open" x-on:click.outside="open = false"
                        class="absolute z-50 w-full bg-white border border-gray-300 max-h-40 overflow-y-auto dark:bg-gray-700 dark:border-gray-600">
                        <template x-for="item in filteredItems" :key="item.id">
                            <li x-on:click="handleClickOption(item)"
                                class="px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer dark:text-white"
                                x-text="item.nama"></li>
                        </template>
                    </ul>
                    <input type="hidden" name="masjid_id" x-model="idVal">
                </div>
            </div>

            <div class="col-span-4">
                <x-input-label class="mb-2" for="search-tanggal" value="Tanggal" />
                <div x-data="{
                    search: '',
                    open: false,
                    initVal: '--Pilih--',
                    idVal: null,
                    items: {{ json_encode($list_agenda->values()) }},
                
                    get filteredItems() {
                        return this.items.filter(i => (i.tgl ?? '').toLowerCase().includes(this.search.toLowerCase()));
                    },
                
                    handleClickOption(item) {
                        this.idVal = item.id;
                        this.search = item.tgl;
                        this.open = false;
                    },
                
                    resetIdVal() {
                        if (this.search === '') {
                            this.idVal = null;
                        }
                    }
                }" class="relative w-full">
                    <input type="search" id="search-tanggal" x-model="search" x-on:click="open = !open"
                        x-on:input="resetIdVal"
                        class="block w-full border border-gray-400 px-3 py-2 rounded dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                    <span class="absolute top-0 start-0 h-full p-3 text-sm font-medium rounded-e-lg"
                        :class="search.length === 0 ? 'text-gray-400 dark:text-gray-400' : 'text-gray-900 dark:text-white'"
                        x-text="search.length === 0 ? initVal : ''">
                    </span>
                    <span x-show="search.length < 1"
                        class="absolute top-0 end-0 h-full p-2 text-sm font-medium rounded-e-lg">
                        <x-remix-icon class="ri-arrow-down-s-line text-gray-600 dark:text-gray-400 text-xl" />
                    </span>
                    <ul x-show="open" x-on:click.outside="open = false"
                        class="absolute z-50 w-full bg-white border border-gray-300 max-h-40 overflow-y-auto dark:bg-gray-700 dark:border-gray-600">
                        <template x-for="item in filteredItems" :key="item.id">
                            <li x-on:click="handleClickOption(item)"
                                class="px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer dark:text-white"
                                x-text="item.tgl"></li>
                        </template>
                    </ul>
                    <input type="hidden" name="agenda_id" x-model="idVal">
                </div>
            </div>

            <div class="col-span-4">
                <x-input-label class="mb-2" for="search-ustadz" value="Ustadz" />
                <div x-data="{
                    search: '',
                    open: false,
                    initVal: '--Pilih--',
                    idVal: null,
                    items: {{ json_encode($list_ustadz) }},
                
                    get filteredItems() {
                        return this.items.filter(i => i.nama.toLowerCase().includes(this.search.toLowerCase()));
                    },
                
                    handleClickOption(item) {
                        this.idVal = item.id;
                        this.search = item.nama;
                        this.open = false;
                    },
                
                    resetIdVal() {
                        if (this.search === '') {
                            this.idVal = null;
                        }
                    }
                }" class="relative w-full">
                    <input type="search" id="search-ustadz" x-model="search"
                        x-on:click="open = !open"x-on:input="resetIdVal"
                        class="block w-full border border-gray-400 px-3 py-2 rounded dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                    <span class="absolute top-0 start-0 h-full p-3 text-sm font-medium rounded-e-lg"
                        :class="search.length === 0 ? 'text-gray-400 dark:text-gray-400' : 'text-gray-900 dark:text-white'"
                        x-text="search.length === 0 ? initVal : ''">
                    </span>
                    <span x-show="search.length < 1"
                        class="absolute top-0 end-0 h-full p-2 text-sm font-medium rounded-e-lg">
                        <x-remix-icon class="ri-arrow-down-s-line text-gray-600 dark:text-gray-400 text-xl" />
                    </span>
                    <ul x-show="open" x-on:click.outside="open = false"
                        class="absolute z-50 w-full bg-white border border-gray-300 max-h-40 overflow-y-auto dark:bg-gray-700 dark:border-gray-600">
                        <template x-for="item in filteredItems" :key="item.id">
                            <li x-on:click="handleClickOption(item)"
                                class="px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer dark:text-white"
                                x-text="item.nama"></li>
                        </template>
                    </ul>
                    <input type="hidden" name="ustadz_id" x-model="idVal">
                </div>
            </div>

            <div class="col-span-4">
                <x-input-label class="mb-2" for="search-ustadz" value="Nama Warga" />
                <div x-data="{
                    search: '',
                    open: false,
                    initVal: '--Pilih--',
                    idVal: null,
                    items: {{ json_encode(
                        $list_warga->map(function ($warga) {
                            return ['id' => $warga->nama, 'nama' => $warga->nama];
                        }),
                    ) }},
                
                    get filteredItems() {
                        return this.items.filter(i => i.nama.toLowerCase().includes(this.search.toLowerCase()));
                    },
                
                    handleClickOption(item) {
                        this.idVal = item.id;
                        this.search = item.nama;
                        this.open = false;
                    },
                
                    resetIdVal() {
                        if (this.search === '') {
                            this.idVal = null;
                        }
                    }
                }" class="relative w-full">
                    <input type="search" id="search-ustadz" x-model="search" x-on:click="open = !open"
                        x-on:input="resetIdVal"
                        class="block w-full border border-gray-400 px-3 py-2 rounded dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                    <span class="absolute top-0 start-0 h-full p-3 text-sm font-medium rounded-e-lg"
                        :class="search.length === 0 ? 'text-gray-400 dark:text-gray-400' : 'text-gray-900 dark:text-white'"
                        x-text="search.length === 0 ? initVal : ''">
                    </span>
                    <span x-show="search.length < 1"
                        class="absolute top-0 end-0 h-full p-2 text-sm font-medium rounded-e-lg">
                        <x-remix-icon class="ri-arrow-down-s-line text-gray-600 dark:text-gray-400 text-xl" />
                    </span>
                    <ul x-show="open" x-on:click.outside="open = false"
                        class="absolute z-50 w-full bg-white border border-gray-300 max-h-40 overflow-y-auto dark:bg-gray-700 dark:border-gray-600">
                        <template x-for="item in filteredItems" :key="item.id">
                            <li x-on:click="handleClickOption(item)"
                                class="px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer dark:text-white"
                                x-text="item.nama"></li>
                        </template>
                    </ul>
                    <input type="hidden" name="nama_warga" x-model="idVal">
                </div>
            </div>

            <div class="col-span-4">
                <x-input-label for="is_include_lampiran" class="mb-2" value="Sertakan Lampiran Jadwal" />
                <ul class="grid w-full md:grid-cols-2">
                    <li>
                        <input type="radio" id="include_lampiran_true" name="is_include_lampiran" value="1"
                            class="peer hidden" required />
                        <label for="include_lampiran_true"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-e-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">Ya</div>
                        </label>
                    </li>
                    <li>
                        <input checked type="radio" id="include_lampiran_false" name="is_include_lampiran"
                            value="0" class="peer hidden" />
                        <label for="include_lampiran_false"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg rounded-s-none border border-gray-300 bg-white p-2 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-700 peer-checked:text-white dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:peer-checked:bg-blue-600 dark:peer-checked:text-white">
                            <div class="block w-full text-center">
                                Tidak
                            </div>
                        </label>
                    </li>
                </ul>
                <p class="mt-1 text-xs font-mono text-gray-500 dark:text-gray-300" id="aset_help">
                    Inputan khusus jika memilih <strong>Lembar Permohonan</strong> untuk <strong>Takjil</strong>
                </p>
                <x-input-error :messages="$errors->get('mode')" class="mt-2" />
            </div>

            <div class="col-span-full">
                <button
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    type="submit">Download</button>
            </div>

        </div>
    </form>

    <div class="col-span-full m-4">
        <div id="alert-additional-content-5"
            class="p-4 border border-gray-300 rounded-lg bg-gray-50 dark:border-gray-600 dark:bg-gray-800"
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
                <ol start="1" class="list-decimal pl-5">
                    <li><strong>Blangko Kosong Kultum Masjid:</strong> Pilih masjid yang akan digunakan. Pilih tipe Imam
                        dan Pembicara. Tidak perlu memilih tanggal atau ustadz.</li>
                    <li><strong>Jadwal Kultum Masjid:</strong> Pilih masjid yang akan digunakan. Pilih tipe Imam dan
                        Pembicara. Tidak perlu memilih tanggal atau ustadz.</li>
                    <li><strong>Lembar Permohonan Kultum Semua Ustadz:</strong> Pilih masjid. Permohonan ini berlaku
                        untuk semua ustadz di masjid tersebut. Pilih tipe Imam dan Pembicara.</li>
                    <li><strong>Lembar Permohonan Kultum Berdasarkan Tanggal atau Ustadz:</strong> Pilih masjid,
                        tanggal, dan ustadz yang relevan. Pilih tipe Imam dan Pembicara.</li>
                    <li><strong>Blangko Kosong Takjil Masjid:</strong> Pilih masjid yang akan digunakan. Pilih tipe
                        Takjil. Tidak perlu memilih tanggal atau warga.</li>
                    <li><strong>Jadwal Takjil Masjid:</strong> Pilih masjid yang akan digunakan. Pilih tipe Takjil.
                        Tidak perlu memilih tanggal atau warga.</li>
                    <li><strong>Lembar Permohonan Takjil Semua Warga Masjid:</strong> Pilih masjid. Permohonan ini
                        berlaku untuk semua warga di masjid tersebut. Pilih tipe Takjil.</li>
                    <li><strong>Lembar Permohonan Takjil Berdasarkan Tanggal atau Nama Warga:</strong> Pilih masjid,
                        tanggal, atau nama warga yang relevan. Pilih tipe Takjil.</li>
                </ol>
            </div>
            <div class="flex">
                <button type="button"
                    class="text-gray-800 bg-transparent border border-gray-700 hover:bg-gray-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-gray-800 dark:text-gray-300 dark:hover:text-white"
                    data-dismiss-target="#alert-additional-content-5" aria-label="Close">
                    Dismiss
                </button>
            </div>
        </div>
    </div>

</x-ap-layout>
