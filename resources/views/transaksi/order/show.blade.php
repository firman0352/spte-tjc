<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Orders Details') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg w-1/2">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between lg:flex-row flex-col">
                        <h1 class="text-xl lg:text-2xl font-semibold text-black">
                            {{ $orders->penawaran->pengajuan->user->dokumenCustomer->nama_pt }}</h1>
                        <x-status-orders :status="$orders->status_order->status" :status_id="$orders->status_order_id" />
                    </div>
                    <div class="w-full h-[2px] bg-indigo-500 my-2 opacity-50"></div>
                    <div class="flex justify-between">
                        <div>
                            <p class="mb-2 text-black"><strong class="text-gray-400">Product Name:</strong>
                                {{ $orders->penawaran->pengajuan->nama_produk }}</p>
                            <p class="mb-2 text-black"><strong class="text-gray-400">Amount of Product:</strong>
                                {{ $orders->penawaran->pengajuan->jumlah }}</p>
                            <p class="mb-2 text-black"><strong class="text-gray-400">Price:</strong>
                                ${{ number_format(floatval($orders->penawaran->harga), 2, '.', ',') }} / Tons</p>
                            </p>
                            @php
                                $total = floatval($orders->penawaran->pengajuan->jumlah) * floatval($orders->penawaran->harga);
                                $formattedTotal = number_format($total, 2, '.', ',');
                            @endphp
                            <p class="mb-2 text-black"><strong class="text-gray-400">Total:</strong>
                                ${{ $formattedTotal }}</p>
                            @php
                                $percentageString1 = $orders->pembayaran->pembayaran_term1;
                                $percentageString2 = $orders->pembayaran->pembayaran_term2;
                                $percentageString3 = $orders->pembayaran->pembayaran_term3;
                                $percentage1 = (float) str_replace('%', '', $percentageString1); // Convert string to float
                                $percentage2 = (float) str_replace('%', '', $percentageString2); // Convert string to float
                                $percentage3 = (float) str_replace('%', '', $percentageString3); // Convert string to float

                                $number = floatval($total); // Replace this with your actual number

                                $result1 = ($percentage1 / 100) * $number; // Calculate the result
                                $result2 = ($percentage2 / 100) * $number; // Calculate the result
                                $result3 = ($percentage3 / 100) * $number; // Calculate the result
                            @endphp
                            <p class="mb-2 text-black"><strong class="text-gray-400">1st term price:</strong>
                                ${{ number_format($result1, 2, '.', ',') }}</p>
                            <p class="mb-2 text-black"><strong class="text-gray-400">2nd term price:</strong>
                                ${{ number_format($result2, 2, '.', ',') }}</p>
                            <p class="mb-2 text-black"><strong class="text-gray-400">3rd term price:</strong>
                                ${{ number_format($result3, 2, '.', ',') }}</p>

                        </div>
                        <div>
                            <a href="{{ app('getTempUrl')($orders->kontrak->kontrak_file) }}" target="_blank"
                                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                Contract Document
                            </a>
                        </div>
                    </div>

                    @if ($orders->pembayaran->invoice_term1)
                        <a href="{{ app('getTempUrl')($orders->pembayaran->invoice_term1) }}" target="_blank"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                            1st INV
                        </a>
                    @endif

                    @if ($orders->pembayaran->invoice_term2)
                        <a href="{{ app('getTempUrl')($orders->pembayaran->invoice_term2) }}" target="_blank"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                            2nd INV
                        </a>
                    @endif

                    @if ($orders->pembayaran->invoice_term3)
                        <a href="{{ app('getTempUrl')($orders->pembayaran->invoice_term3) }}" target="_blank"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                            3rd INV
                        </a>
                    @endif

                </div>
            </div>
            <div
                class="mt-4 p-6 bg-white border-b border-gray-200 overflow-hidden bg-white shadow-sm sm:rounded-lg w-1/2 flex flex-col gap-9">
                @if ($orders->progress)
                    @if (!empty($orders->progress->in_production))
                        <div>
                            <p class="mb-2 text-black font-bold">Production Photos</p>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach ($orders->progress->in_production as $photos)
                                    <a href="{{ $photos }}" data-lightbox="image-1"
                                        data-title="Production Photos" class="flex justify-center">
                                        <img src="{{ $photos }}" alt="product_packing">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!empty($orders->progress->product_finished))
                        <div>
                            <p class="mb-2 text-black font-bold">Finished Production Photos</p>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach ($orders->progress->product_finished as $photos)
                                    <a href="{{ $photos }}" data-lightbox="image-1"
                                        data-title="Production Finishied Photos" class="flex justify-center">
                                        <img src="{{ $photos }}" alt="product_packing">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!empty($orders->progress->product_packing))
                        <div>
                            <p class="mb-2 text-black font-bold">Product Packing Photos</p>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach ($orders->progress->product_packing as $photos)
                                    <a href="{{ $photos }}" data-lightbox="image-1"
                                        data-title="Packing Product Photos" class="flex justify-center">
                                        <img src="{{ $photos }}" alt="product_packing">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!empty($orders->progress->product_container))
                        <div>
                            <p class="mb-2 text-black font-bold">Product Container Photos</p>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach ($orders->progress->product_container as $photos)
                                    <a href="{{ $photos }}" data-lightbox="image-1"
                                        data-title="Container Product Photos" class="flex justify-center">
                                        <img src="{{ $photos }}" alt="product_packing">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

