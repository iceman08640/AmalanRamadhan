@props([
    "title",
    "page",
    "active" => false,
    "route" => "",
    "path" => true,
    "back" => false,
    "addButton" => false,
])

<div
    class="block w-full items-center border-b border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800 sm:flex"
>
    <div class="w-full">
        @if ($path === true)
            <nav class="mb-5 flex" aria-label="Breadcrumb">
                <ol
                    class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2"
                >
                    @if ($active === false)
                        <li class="inline-flex items-center">
                            <span
                                class="inline-flex items-center text-gray-700 dark:text-gray-300"
                            >
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        <li class="inline-flex items-center">
                            <a
                                href="{{ $route }}"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white"
                            >
                                {{ $page }}
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg
                                    class="h-6 w-6 text-gray-400"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                <span
                                    class="ml-1 text-gray-400 dark:text-gray-500 md:ml-2"
                                    aria-current="page"
                                >
                                    {{ $active }}
                                </span>
                            </div>
                        </li>
                    @endif
                </ol>
            </nav>
        @endif

        <div class="flex items-center justify-between">
            <div
                x-data="{
                    handleClick() {
                        history.back()
                    },
                }"
                class="flex justify-items-center font-semibold text-gray-900 dark:text-white sm:text-2xl"
            >
                @if ($back)
                    <button
                        x-on:click="handleClick()"
                        class="text-md mr-2 inline-flex items-center rounded-md px-1.5 text-center hover:bg-blue-700"
                    >
                        <x-remix-icon
                            class="ri-arrow-left-line inline-flex items-center font-thin text-gray-700 hover:text-white dark:text-gray-300 dark:hover:text-white"
                        ></x-remix-icon>
                    </button>
                @endif

                <h1>{{ $title }}</h1>
            </div>
            @if ($addButton)
                <div class="flex">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
</div>
