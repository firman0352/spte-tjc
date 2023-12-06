<x-app-layout>
    <x-slot name="title">
        {{ __('Verification Details') }}
    </x-slot>
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
                        <h1 class="text-2xl lg:text-4xl font-semibold text-black">
                            {{ $verifikasi->dokumenCustomer->nama_pt }}</h1>
                        <x-status-badge :status_id="$verifikasi->status_id" :status="$verifikasi->statusDokumen->status" />
                    </div>
                    <div class="w-full h-[2px] bg-indigo-500 my-2 opacity-50"></div>
                    <div class="flex justify-between">
                        <div>
                            <p class="text-black"><strong class="text-gray-400">Address:</strong>
                                {{ $verifikasi->dokumenCustomer->alamat_pt }}</p>
                            @if (auth()->user()->inspektur->jabatan_id == 1)
                                @if ($verifikasi->status_id == 6)
                                    <div class="flex flex-row items-center mt-10 gap-4 w-full">
                                        <form method="post"
                                            action="{{ route('inspektur.verifikasi.approve', ['verifikasi' => $verifikasi]) }}"
                                            class="flex flex-col items-center">
                                            @csrf
                                            @method('patch')
                                            <button type="submit"
                                                class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800 gap-1 hover:bg-green-200 hover:text-green-900">
                                                <svg fill="none" stroke="currentColor" stroke-width="3.5"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" width="15px">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5"></path>
                                                </svg>
                                                <span>Approve</span>
                                            </button>
                                        </form>
                                        <div class="flex flex-col items-center">
                                            <button onclick="openModal()"
                                                class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-red-100 text-red-800 gap-1 hover:bg-red-200 hover:text-red-900">
                                                <svg fill="none" stroke="currentColor" stroke-width="3.5"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" width="15px">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span>Reject</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @elseif(auth()->user()->inspektur->jabatan_id == 2)
                                @if ($verifikasi->status_id == 7)
                                    <div class="flex flex-row items-center mt-10 gap-4 w-full">
                                        <form method="post"
                                            action="{{ route('inspektur.verifikasi.approve', ['verifikasi' => $verifikasi]) }}"
                                            class="flex flex-col items-center">
                                            @csrf
                                            @method('patch')
                                            <button type="submit"
                                                class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800 gap-1 hover:bg-green-200 hover:text-green-900">
                                                <svg fill="none" stroke="currentColor" stroke-width="3.5"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" width="15px">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5"></path>
                                                </svg>
                                                <span>Approve</span>
                                            </button>
                                        </form>
                                        <div class="flex flex-col items-center">
                                            <button onclick="openModal()"
                                                class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-red-100 text-red-800 gap-1 hover:bg-red-200 hover:text-red-900">
                                                <svg fill="none" stroke="currentColor" stroke-width="3.5"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" width="15px">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span>Reject</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div>
                            @if ($verifikasi->dokumenCustomer->dokumen)
                                <a href="{{ $verifikasi->dokumenCustomer->getTempUrl($verifikasi->dokumenCustomer->dokumen) }}"
                                    target="_blank"
                                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                    View Dokumen
                                </a>
                            @else
                                <p class="text-gray-500">No Dokumen Available</p>
                            @endif

                        </div>
                    </div>
                    <div class="mt-1">
                        <a href="{{ route('inspektur.verifikasi.index') }}"
                            class="font-bold text-indigo-600 hover:underline">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Modal -->
<div id="myModal"
    style="display: none; position: absolute; top: 0; left: 0; background: rgba(0, 0, 0, 0.5); width: 100%; height: 100%; z-index: 50;">
    <div
        style="background: white; width: 60%; margin: 10% auto; padding: 20px; border: 1px solid #888; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <span onclick="closeModal()" style="color: #aaa; float: right; font-size: 28px; cursor: pointer;">&times;</span>
        <form method="post" action="{{ route('inspektur.verifikasi.reject', ['verifikasi' => $verifikasi]) }}">
            @csrf
            @method('patch')
            <input type="text" name="comment" placeholder="Comment"
                style="border: 1px solid #ccc; padding: 10px; margin: 10px 0; width: 100%;" required>
            <button type="submit"
                class="inline-flex items-center rounded-md border border-red-300 bg-red-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm transition duration-150 ease-in-out hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">Decline</button>
            <button type="button" onclick="closeModal()"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">Cancel</button>
        </form>
    </div>
</div>

<script>
    function openModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';
    }

    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }
</script>
