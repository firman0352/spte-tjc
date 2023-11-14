<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Pengajuan') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div>
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <div class="min-w-full align-middle">
                        <table class="min-w-full border divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Nama Perusahaan</span>
                                    </th>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Nama Produk</span>
                                    </th>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Jumlah</span>
                                    </th>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Status Pengajuan</span>
                                    </th>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Status Penawaran Harga</span>
                                    </th>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Dokumen</span>
                                    </th>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach($pengajuan as $p)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->user->dokumenCustomer->nama_pt }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->nama_produk }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->jumlah }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->statusPengajuan->status }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            @if($p->penawaranHarga)
                                                {{ $p->penawaranHarga->status->status }}
                                                @else
                                                -
                                            @endif
                                        <td>
                                        <td>
                                            <a href="{{ $p->tempUrl }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                View Dokumen
                                            </a>
                                        </td>
                                        <td>
                                        @if ($p->status_id == 1)
                                            <a href="{{ route('admin.pengajuan.process', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                Process Pengajuan
                                            </a>                                          
                                        @elseif ($p->status_id == 2)
                                            <a href="{{ route('admin.penawaran-harga.show', $p->PenawaranHarga->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                Show Penawaran Harga
                                            </a>
                                        @endif
                                        @if ($p->PenawaranHarga)
                                            @if ($p->PenawaranHarga->status_id == 2)
                                                <a href="{{ route('admin.orders.create', $p->PenawaranHarga->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                    Process Order
                                                </a>
                                            @endif
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
