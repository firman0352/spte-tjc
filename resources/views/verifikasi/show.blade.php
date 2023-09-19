<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Verification Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold mb-4">{{ $verifikasi->dokumenCustomer->nama_pt }}</h1>
                    
                    <p class="mb-2"><strong>Inspektur:</strong> {{ $verifikasi->inspektur->user->name }}</p>
                    <p class="mb-2"><strong>Status:</strong> {{ $verifikasi->statusDokumen->status }}</p>
                    <p class="mb-2"><strong>Tanggal Mulai:</strong> {{ $verifikasi->tanggal_mulai }}</p>
                    <p class="mb-4"><strong>Tanggal Selesai:</strong> {{ $verifikasi->tanggal_selesai ?: 'Not Set' }}</p>
                    
                    @if ($verifikasi->dokumenCustomer->dokumen)
                        <a href="{{ $verifikasi->dokumenCustomer->getTempUrl($verifikasi->dokumenCustomer->dokumen) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                            View Dokumen
                        </a>
                    @else
                        <p class="text-gray-500">No Dokumen Available</p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('verifikasi.index') }}" class="text-indigo-600 hover:underline">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
