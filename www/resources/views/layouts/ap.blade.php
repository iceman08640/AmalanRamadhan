<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Sistem Informasi Manajemen Rumah Sakit Univesitan Muhammadiyah Surakarta untuk Simulasi Mahasiswa" />
    <meta name="author" content="Themesberg" />
    <meta name="generator" content="Hugo 0.122.0" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="theme-color" content="#ffffff" />
    <title>{{ $identitas->nama_sistem }}</title>
    <style>
        ::-webkit-scrollbar {
            width: 3px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgba(155, 155, 155, 0.5);
            border-radius: 10px;
            border: transparent;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    {{-- Header --}}
    @include('partials.__header', ['identitas' => $identitas])

    <div class="flex overflow-hidden bg-gray-50 pt-16 dark:bg-gray-900">
        @include('partials.__sidebar')

        <x-dashboard.sidebar.backdrop />

        <div id="main-content" class="relative h-full w-full overflow-y-auto bg-gray-50 dark:bg-gray-900 lg:ml-64">
            @isset($header)
                <header class="bg-white shadow">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="{{ asset('js/app.bundle.js') }}"></script>
    {{-- <script src="{{ asset('js/datepicker.min.js') }}"></script> --}}
    <script src="{{ asset('js/custom.js') }}"></script>
    @stack('scripts')
</body>

</html>
