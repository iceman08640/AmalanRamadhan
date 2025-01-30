@props([
    'width' => 24,
    'height' => 24,
])

<i aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="{{ $width }}" height="{{ $height }}"
    fill="currentColor" viewBox="0 0 {{ $width }} {{ $height }}"
    {{ $attributes->merge(['class' => 'text-gray-500 dark:text-gray-400']) }}>
</i>
