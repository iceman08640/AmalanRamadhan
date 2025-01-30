<x-ap-layout>
    <x-breadcrumb title="Takjil Baru" page="Takjil Management" active="Takjil Baru" route="{{ route('takjil.index') }}"
        back="true" />

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert value="{{ $error }}" tipe="danger" />
        @endforeach
    @endif

    @if (session('status'))
        <x-alert value="{{ session('status') }}" tipe="{{ session('tipe') }}" class="max-w-md" />
    @endif

    <div
        class="p-4 m-4 max-w-md bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <form action="{{ route('takjil.store') }}" method="POST">
            @csrf

            <div class="mb-5">
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
                    <input type="search" id="search-masjid" x-model="search"
                        x-on:click="open = !open"x-on:input="resetIdVal"
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

            <div class="mb-5">
                <x-input-label class="mb-2" for="search-tanggal">Tanggal <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <div x-data="{
                    search: '',
                    open: false,
                    initVal: '--Pilih--',
                    idVal: null,
                    items: {{ json_encode($list_agenda) }},
                
                    get filteredItems() {
                        return this.items.filter(i => i.tgl.toLowerCase().includes(this.search.toLowerCase()));
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
                    <input type="search" id="search-tanggal" x-model="search"
                        x-on:click="open = !open"x-on:input="resetIdVal"
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
                                x-text="item.tgl"></li>
                        </template>
                    </ul>
                    <input type="hidden" name="agenda_id" x-model="idVal">
                </div>
            </div>

            <div class="mb-7">
                <x-input-label class="mb-2" for="nama">Nama Warga <span
                        class="text-sm text-red-600">*</span></x-input-label>
                <x-text-input id="nama" type="text" name="nama" :value="old('nama')" required />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>

            <div class="flex items-center col-span-6 sm:col-full">
                <button
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    type="submit">Simpan</button>
            </div>
        </form>
    </div>

</x-ap-layout>
