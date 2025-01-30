@props([
    'path' => 'https://flowbite-admin-dashboard.vercel.app/',
    'content' => 'Dashboard',
    'isActive' => false,
    'disable' =>
        'flex p-2 items-center text-base transition duration-75 rounded-lg group hover:bg-gray-200 dark:text-gray-200 dark:hover:bg-gray-700',
    'enable' =>
        'flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-200 group dark:text-gray-200 dark:hover:bg-gray-700  bg-gray-200 dark:bg-gray-700',
])


<a href="{{ $path }}" {{ $attributes->merge(['class' => $isActive ? $enable : $disable]) }}>
    {{ $slot }}
    <span class="ml-3" sidebar-toggle-item>{{ $content }}</span>
</a>
