<a href="{{ route('dashboard.index') }}" class="ml-2 flex md:mr-24">
    @if ($identitas && $identitas->aset_id !== null)
        <img class="block h-9 w-auto fill-current text-red-800" src="{{ route('aset.show', $identitas->aset_id) }}"
            alt="Logo {{ $identitas->nama_sistem }}" />
    @endif

    <span class="ms-2 self-center whitespace-nowrap text-xl font-semibold dark:text-white sm:text-2xl">
        {{ $identitas ? $identitas->nama_sistem : 'Apotek Ananda' }}
    </span>
</a>
