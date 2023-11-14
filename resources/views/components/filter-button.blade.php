@props(['active' => false])

@php
    $defaultClasses = 'px-2 inline-flex text-sm leading-5 font-semibold rounded-full border-2 bg-gray-50 text-gray-500 hover:bg-gray-100';
    $activeClasses = 'px-2 inline-flex text-sm leading-5 font-semibold rounded-full border-2 border-indigo-500 bg-indigo-50 text-indigo-500 hover:bg-indigo-100 hover:text-indigo-600';

    $classes = $active ? $defaultClasses . ' ' . $activeClasses : $defaultClasses;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
