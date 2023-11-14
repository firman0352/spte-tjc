<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Orders Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="mb-2"><strong>Nama Perusahaan:</strong> {{ $orders->penawaran->pengajuan->user->dokumenCustomer->nama_pt }}</p>
                    <p class="mb-2"><strong>Nama Produk:</strong> {{ $orders->penawaran->pengajuan->nama_produk }}</p>
                    <p class="mb-2"><strong>Jumlah Produk:</strong> {{ $orders->penawaran->pengajuan->jumlah }}</p>
                    <p class="mb-2"><strong>Harga:</strong> {{ $orders->penawaran->harga }}</p>             
                    <p class="mb-2"><strong>Status:</strong> {{ $orders->status_order->status }}</p>

                    <a href="{{ app('getTempUrl')($orders->kontrak->kontrak_file) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                        View Contract Document
                    </a>

                    @if ($orders->pembayaran->invoice_term1)
                        <a href="{{ app('getTempUrl')($orders->pembayaran->invoice_term1) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                            View 1st Term Invoice
                        </a>
                    @endif

                    @if ($orders->pembayaran->invoice_term2)
                        <a href="{{ app('getTempUrl')($orders->pembayaran->invoice_term2) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                            View 2nd Term Invoice
                        </a>
                    @endif

                    @if ($orders->pembayaran->invoice_term3)
                        <a href="{{ app('getTempUrl')($orders->pembayaran->invoice_term3) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                            View 3rd Term Invoice
                        </a>
                    @endif

                </div>
                <a href="google.com" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                        View Dokumen
                </a>
                @if ($orders->progress)
                    @if (!empty($orders->progress->in_production))
                        @foreach ($orders->progress->in_production as $photos)
                            <p class="mb-2"><strong>Produksi:</strong> {{ $photos }}</p>
                        @endforeach
                    @endif
                    @if (!empty($orders->progress->product_finished))
                        @foreach ($orders->progress->product_finished as $photos)
                            <p class="mb-2"><strong>Finished:</strong> {{ $photos }}</p>
                        @endforeach
                    @endif
                    @if (!empty($orders->progress->product_packing))
                        @foreach ($orders->progress->product_packing as $photos)
                            <p class="mb-2"><strong>Packing:</strong> {{ $photos }}</p>
                            <img src="{{ $photos }}" alt="product_packing" class="w-1/4">
                        @endforeach
                    @endif
                    @if (!empty($orders->progress->product_container))
                        @foreach ($orders->progress->product_container as $photos)
                            <p class="mb-2"><strong>Container:</strong> {{ $photos }}</p>
                        @endforeach
                    @endif
                @endif     
            </div>
        </div>
    </div>
</x-app-layout>  