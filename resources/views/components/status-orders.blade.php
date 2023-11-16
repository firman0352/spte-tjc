@props(['status_id', 'status'])

@php
    $badgeClasses = [
        1 => 'bg-amber-100 text-amber-800',
        2 => 'bg-amber-100 text-amber-800',
        3 => 'bg-lime-100 text-lime-800',
        4 => 'bg-emerald-100 text-emerald-800',
        5 => 'bg-yellow-100 text-yellow-800',
        6 => 'bg-orange-100 text-orange-800',
        7 => 'bg-blue-100 text-blue-800',
        8 => 'bg-lime-100 text-lime-800',
        9 => 'bg-emerald-100 text-emerald-800',
        10 => 'bg-yellow-100 text-yellow-800',
        11 => 'bg-lime-100 text-lime-800',
        12 => 'bg-emerald-100 text-emerald-800',
        13 => 'bg-orange-100 text-orange-800',
        14 => 'bg-sky-100 text-sky-800',
        15 => 'bg-green-100 text-green-800',
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
