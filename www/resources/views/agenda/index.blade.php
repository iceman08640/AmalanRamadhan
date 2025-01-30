<x-ap-layout>
    <x-breadcrumb title="Agenda Management" page="Agenda Management" addButton="true">
        <a href="{{ route('agenda.create') }}"
            class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            <x-remix-icon class="ri-add-large-fill mr-1 font-bold text-white dark:text-white" />
            Agenda
        </a>
        <a href="{{ route('agenda.create.quick.mode') }}"
            class="inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 ms-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <x-remix-icon class="ri-timer-flash-fill mr-1 font-bold text-white dark:text-white" />
            Quick Mode
        </a>
    </x-breadcrumb>

    <div
        class="block items-center justify-between bg-white p-4 dark:divide-gray-700 dark:bg-gray-800 sm:flex md:divide-x md:divide-gray-100">
        <div class="mb-4 flex flex-col sm:mb-0">
            <form class="flex flex-col items-start sm:flex-row sm:items-center" action="{{ route('agenda.index') }}"
                method="GET">
                <label for="Name" class="sr-only">Cari</label>
                <div class="relative mr-3 w-full mb-4 sm:mb-0 sm:w-80">
                    <select name="tipe" id="tipe"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:text-sm">
                        <option value="" {{ !request('tipe') ? 'selected' : '' }}>Semua Tipe Agenda
                        </option>
                        <option value="takjil" {{ request('tipe') == 'takjil' ? 'selected' : '' }}>Takjil</option>
                        <option value="kultum" {{ request('tipe') == 'kultum' ? 'selected' : '' }}>Kultum</option>
                    </select>
                </div>
                <div class="flex w-full sm:w-auto">
                    <button type="submit" class="rounded-full bg-gray-200 p-0.5 px-2 dark:bg-gray-600">
                        <x-remix-icon class="ri-search-2-line text-lg"></x-remix-icon>
                    </button>
                    <a href="{{ route('agenda.index') }}" data-tooltip-target="tooltip-default"
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
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                    Tipe
                                </th>
                                <th scope="col"
                                    class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                    Keterangan
                                </th>
                                <th scope="col"
                                    class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col"
                                    class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($list_agenda as $agenda)
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
                                            {{ \Carbon\Carbon::parse($agenda->tgl)->translatedFormat('d M Y') }}
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap p-4 text-base font-medium text-gray-900 dark:text-white">
                                        {{ $agenda->tipe }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap p-4 text-base font-medium text-gray-900 dark:text-white">
                                        {{ $agenda->is_takbiran ? 'Takbiran, ' . \Carbon\Carbon::parse($agenda->waktu)->translatedFormat('H:i') : '' }}
                                    </td>

                                    @if ($agenda->is_active)
                                        <td
                                            class="whitespace-nowrap p-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <span
                                                class="me-2 rounded bg-green-100 px-2.5 py-0.5 text-sm font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                                {{ Str::upper('aktif') }}
                                            </span>
                                        </td>
                                    @else
                                        <td
                                            class="whitespace-nowrap p-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <span
                                                class="me-2 rounded bg-red-100 px-2.5 py-0.5 text-sm font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                                {{ Str::upper('tidak aktif') }}
                                            </span>
                                        </td>
                                    @endif

                                    <td class="space-x-2 whitespace-nowrap p-4">
                                        <a href="{{ route('agenda.show', $agenda->id) }}"
                                            class="inline-flex items-center rounded-lg bg-primary-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            <x-remix-icon
                                                class="ri-edit-box-fill text-white dark:text-white"></x-remix-icon>
                                        </a>

                                        <button type="button" data-modal-toggle="delete-user-modal{{ $agenda->id }}"
                                            class="inline-flex items-center rounded-lg bg-red-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            <x-remix-icon
                                                class="ri-delete-bin-fill text-white dark:text-white"></x-remix-icon>
                                        </button>
                                    </td>
                                </tr>

                                <div class="fixed left-0 right-0 top-4 z-50 hidden h-modal items-center justify-center overflow-y-auto overflow-x-hidden sm:h-full md:inset-0"
                                    id="delete-user-modal{{ $agenda->id }}">
                                    <div class="relative h-full w-full max-w-md px-4 md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                                            <!-- Modal header -->
                                            <div class="flex justify-end p-2">
                                                <button type="button"
                                                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-700 dark:hover:text-white"
                                                    data-modal-toggle="delete-user-modal{{ $agenda->id }}">
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
                                                        {{ $agenda->nama }}
                                                    </p>
                                                </h3>

                                                <form action="{{ route('agenda.destroy', $agenda->id) }}"
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
                                                    data-modal-toggle="delete-user-modal{{ $agenda->id }}">
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

    {{ $list_agenda->links() }}
</x-ap-layout>
