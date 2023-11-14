@props(['status_id', 'status'])

@php
    $badgeClasses = [
        1 => 'bg-orange-100 text-orange-800',
        2 => 'bg-green-100 text-green-800',
        3 => 'bg-red-100 text-red-800',
        4 => 'bg-rose-100 text-rose-800',
        5 => 'bg-blue-100 text-blue-800',
    ];
@endphp

@if (isset($badgeClasses[$status_id]))
    <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full {{ $badgeClasses[$status_id] }}">
        {{ $status }}
    </span>
@else
    <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
        Unknown Status
    </span>
@endif
