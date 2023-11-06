<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Verification Details') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-full px-4 lg:w-1/2 w-full">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between lg:flex-row flex-col">
                        <h1 class="text-2xl lg:text-4xl font-semibold text-black">{{ $verifikasi->dokumenCustomer->nama_pt }}</h1>
                        @if ($verifikasi->statusDokumen->status === 'Dalam Proses Verifikasi')
                                            <span class="px-2 py-0 lg:py-1 inline-flex text-xs lg:text-md leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $verifikasi->statusDokumen->status }}
                                            </span>
                        @elseif ($verifikasi->statusDokumen->status === 'Disetujui Inspektur 1')
                                            <span class="px-2 py-0 lg:py-1 inline-flex text-xs lg:text-md leading-5 font-semibold rounded-full bg-blue-100 text-green-800">
                                                {{ $verifikasi->statusDokumen->status }}
                                            </span>
                        @elseif ($verifikasi->statusDokumen->status === 'Ditolak')
                                            <span class="px-2 py-0 lg:py-1 inline-flex text-xs lg:text-md leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                {{ $verifikasi->statusDokumen->status }}
                                            </span>
                        @elseif ($verifikasi->statusDokumen->status === 'Sudah Verifikasi')
                                            <span class="px-2 py-0 lg:py-1 inline-flex text-xs lg:text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $verifikasi->statusDokumen->status }}
                                            </span>
                        @elseif ($verifikasi->statusDokumen->status === 'Menunggu Verifikasi')
                                            <span class="px-2 py-0 lg:py-1 inline-flex text-xs lg:text-md leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                                {{ $verifikasi->statusDokumen->status }}
                                            </span>                                            
                        @endif
                    </div>
                    <div class="w-full h-[2px] bg-indigo-500 my-2 opacity-50"></div>
                    <div class="flex justify-between">
                        <div>
                            <p class="mb-2 text-black text-lg font-bold">Inspectors</p>
                            <p class="mb-2 text-black"><strong class="text-gray-400">Inspector I :</strong> {{ $verifikasi->inspektur->user->name }}</p>
                            <p class="mb-2 text-black"><strong class="text-gray-400">Inspector II :</strong> {{ $verifikasi->inspektur2->user->name }}</p>
                        </div>
                    
                        <div>
                            @if ($verifikasi->dokumenCustomer->dokumen)
                            <a href="{{ $verifikasi->dokumenCustomer->getTempUrl($verifikasi->dokumenCustomer->dokumen) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                View Document
                            </a>
                            @else
                            <p class="text-gray-500">No Document Available</p>
                            @endif
                        </div>
                    </div>
                    <p class="mb-2 text-black text-lg font-bold">Time</p>
                    <div class="flex justify-between items-center">
                        <p class="text-black"><strong class="text-gray-400">Start date :</strong> {{ $verifikasi->tanggal_mulai }}</p>
                        <p class="text-black"><strong class="text-gray-400">End date :</strong> {{ $verifikasi->tanggal_selesai ?: 'Not Set' }}</p>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('verifikasi.index') }}" class="font-bold text-indigo-600 hover:underline">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->
