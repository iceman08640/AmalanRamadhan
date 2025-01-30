<x-ap-layout>
    <x-breadcrumb title="Takjil Management" page="Takjil Management" addButton="true">
        <a href="{{ route('takjil.create') }}"
            class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            <x-remix-icon class="ri-add-large-fill mr-1 font-bold text-white dark:text-white" />
            Takjil
        </a>
    </x-breadcrumb>

    <div
        class="block items-center justify-between bg-white p-4 dark:divide-gray-700 dark:bg-gray-800 sm:flex md:divide-x md:divide-gray-100">
        <div class="mb-4 flex flex-col sm:mb-0">
            <form class="flex flex-col items-start sm:flex-row sm:items-center" action="{{ route('takjil.index') }}"
                method="GET">
                <label for="Name" class="sr-only">Cari</label>
                <div class="relative mr-3 w-full mb-4 sm:mb-0 sm:w-80">
                    <select name="masjid" id="masjid"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm">
                        <option value="" {{ !request('masjid') ? 'selected' : '' }}>Semua Masjid</option>
                        @foreach ($list_masjid as $masjid)
                            <option value="{{ $masjid->id }}"
                                {{ request('masjid') == $masjid->id ? 'selected' : '' }}>
                                {{ $masjid->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="relative mr-3 w-full mb-4 sm:mb-0 sm:w-80">
                    <select name="tanggal" id="tanggal"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm">
                        <option value="" {{ !request('tanggal') ? 'selected' : '' }}>Semua Tanggal</option>
                        @foreach ($list_agenda as $agenda)
                            <option value="{{ $agenda->id }}"
                                {{ request('tanggal') == $agenda->id ? 'selected' : '' }}>
                                {{ hariTanggalWaktuIndoTakjil($agenda->tgl, $agenda->is_takbiran, $agenda->waktu) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex w-full sm:w-auto">
                    <button type="submit" class="rounded-full bg-gray-200 p-0.5 px-2 dark:bg-gray-600">
                        <x-remix-icon class="ri-search-2-line text-lg"></x-remix-icon>
                    </button>
                    <a href="{{ route('takjil.index') }}" data-tooltip-target="tooltip-default"
                        data-tooltip-placement="right"
                        class="ml-2 rounded-full bg-gray-200 px-2 py-0.5 dark:bg-gray-600">
                        <x-remix-icon class="ri-eraser-fill text-lg"></x-remix-icon>
                    </a>
                </div>
            </form>
            <div id="tooltip-default" role="tooltip"
                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                Hapus Pencarian
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
    </div>

    @if (session('status'))
        <x-alert value="{{ session('status') }}" tipe="{{ session('tipe') }}" />
    @endif

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                    #
                                </th>
                                <th scope="col"
                                    class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                    Masjid
                                </th>
                                <th scope="col"
                                    class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                    Warga
                                </th>
                                <th scope="col"
                                    class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($list_takjil as $takjil)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="whitespace-nowrap p-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $loop->iteration }}
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap p-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $takjil->masjid->nama }}
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap p-4 text-base font-medium text-gray-900 dark:text-white">
                                        {{ hariTanggalWaktuIndoTakjil($takjil->agenda->tgl, $takjil->agenda->is_takbiran, $takjil->agenda->waktu) }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap p-4 text-base font-medium text-gray-900 dark:text-white">
                                        {{ $takjil->nama }}
                                    </td>

                                    <td class="space-x-2 whitespace-nowrap p-4">
                                        <a href="{{ route('takjil.show', $takjil->id) }}"
                                            class="inline-flex items-center rounded-lg bg-primary-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            <x-remix-icon
                                                class="ri-edit-box-fill text-white dark:text-white"></x-remix-icon>
                                        </a>

                                        <button type="button" data-modal-toggle="delete-user-modal{{ $takjil->id }}"
                                            class="inline-flex items-center rounded-lg bg-red-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            <x-remix-icon
                                                class="ri-delete-bin-fill text-white dark:text-white"></x-remix-icon>
                                        </button>
                                    </td>
                                </tr>

                                <div class="fixed left-0 right-0 top-4 z-50 hidden h-modal items-center justify-center overflow-y-auto overflow-x-hidden sm:h-full md:inset-0"
                                    id="delete-user-modal{{ $takjil->id }}">
                                    <div class="relative h-full w-full max-w-md px-4 md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                                            <!-- Modal header -->
                                            <div class="flex justify-end p-2">
                                                <button type="button"
                                                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-700 dark:hover:text-white"
                                                    data-modal-toggle="delete-user-modal{{ $takjil->id }}">
                                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 pt-0 text-center">
                                                <svg class="mx-auto h-16 w-16 text-red-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <h3 class="mb-6 mt-5 text-lg text-gray-500 dark:text-gray-400">
                                                    Apakah Anda yakin ingin
                                                    menghapus
                                                    <p class="font-bold">
                                                        {{ $takjil->nama }}
                                                    </p>
                                                </h3>

                                                <form action="{{ route('takjil.destroy', $takjil->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="mr-2 inline-flex items-center rounded-lg bg-red-600 px-6 py-2.5 text-center text-base font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
                                                        Ya
                                                    </button>
                                                </form>

                                                <a href="#"
                                                    class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2.5 text-center text-base font-medium text-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                                                    data-modal-toggle="delete-user-modal{{ $takjil->id }}">
                                                    Tidak
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-4 text-center text-gray-900 dark:text-white">
                                        Tidak ada data.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $list_takjil->links() }}
</x-ap-layout>
