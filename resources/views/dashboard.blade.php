<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container max-w-full">
        <div class="max-w-full px-4">
            @if (auth()->user()->roleName() == 'admin')
                @include('dashboard.admin', [
                    'totalUsers' => $totalUsers,
                    'totalDokumenCustomers' => $totalDokumenCustomers,
                    'totalInspector' => $totalInspector,
                ])
            @elseif (auth()->user()->roleName() == 'inspektur')
                @include('dashboard.inspector', [
                    'needVerification1' => $needVerification1,
                    'needVerification2' => $needVerification2,
                ])
            @elseif (auth()->user()->roleName() == 'customer')
                @include('dashboard.customer')
            @endif
        </div>
    </div>
</x-app-layout>

