<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Product Specification Submission') }}
            </h2>
            <a href="{{ route('pengajuan.create') }}"
                class="gap-1 inline-flex items-center rounded-lg border bg-purple-300 border-white-purple px-4 py-2 text-xs font-semibold tracking-widest text-white shadow-sm transition duration-150 ease-in-out hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                <svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg> Add new
            </a>
        </div>
    </x-slot>

    <div class="max-w-full px-4">
        @if (session('success'))
            <div class="alert alert-success px-4 mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger px-4 mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div>
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <div class="min-w-full align-middle">
                        <table id="listTable" class=" nowrap hover compact">
                            <thead>
                                <tr>
                                    <th class="bg-transparant px-6 py-3 text-left w-[15%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Product
                                            Name</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left w-[15%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Amount
                                            of Tons</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[15%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Submission
                                            Status</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[15%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Offering
                                            Status</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[20%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Document</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[20%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach ($pengajuan as $p)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->nama_produk }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->jumlah }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center">
                                            <x-status-multiple :status_id="$p->statusPengajuan->id" :status="$p->statusPengajuan->status" />
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center">
                                            @if ($p->penawaranHarga)
                                                <x-status-multiple :status_id="$p->penawaranHarga->status->id" :status="$p->penawaranHarga->status->status" />
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center">
                                            <a href="{{ $p->tempUrl }}" target="_blank"
                                                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                SPD
                                            </a>
                                            @if ($p->penawaranHarga)
                                                @if ($p->penawaranHarga->dokumen)
                                                    <a href="{{ $p->penawaranHarga->getTempUrl($p->penawaranHarga->dokumen) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                        FOD
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->penawaranHarga)
                                                @if ($p->penawaranHarga->status_id == 1 || $p->penawaranHarga->status_id == 5 || $p->penawaranHarga->status_id == 2)
                                                    <a href="{{ route('penawaran-harga.show', $p->penawaranHarga->id) }}"
                                                        class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-lime-100 text-lime-800 gap-1 hover:bg-lime-200 hover:text-lime-900">
                                                        <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                            aria-hidden="true" width="12px">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                            </path>
                                                        </svg>
                                                        Price Offer Details
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <p class="text-xs opacity-40 text-black">*SPD : Specific Product Document</p>
                            <p class="text-xs opacity-40 text-black">*FOD : Final Offer Document</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
