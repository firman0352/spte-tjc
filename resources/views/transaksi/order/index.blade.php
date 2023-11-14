<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Orders') }}
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
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Status Order</span>
                                    </th>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Documents</span>
                                    </th>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach($orders as $p)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->user->dokumenCustomer->nama_pt }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->penawaran->pengajuan->nama_produk }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->penawaran->pengajuan->jumlah }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->status_order->status }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        @if ($p->progress)
                                            @if ($p->progress->lab_test_document)
                                                <a href="{{ app('getTempUrl')($p->progress->lab_test_document) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                    Lab Test
                                                </a>
                                            @endif

                                            @if ($p->progress->shipping_document)
                                                <a href="{{ app('getTempUrl')($p->progress->shipping_document) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                    Shipping Doc
                                                </a>
                                            @endif

                                            @if ($p->progress->bill_of_lading)
                                                <a href="{{ app('getTempUrl')($p->progress->bill_of_lading) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                    BOL
                                                </a>
                                            @endif                                         
                                        @endif
                                        </td>
                                        <td>
                                        @switch($p->status_order_id)
                                            @case(1)
                                                @customer
                                                    <a href="{{ route('orders.upload-kontrak', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover-bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload Signed Contract
                                                    </a>
                                                @endcustomer
                                                @break
                                            @case(2)
                                                @customer
                                                    <a href="{{ route('orders.upload-1st-term', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover-bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload 1st Term Payment Proof
                                                    </a>
                                                @endcustomer
                                                @break
                                            @case(3)
                                                @admin
                                                    <a href="{{ route('admin.orders.upload-1st-invoice', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover-bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload 1st Term Invoice
                                                    </a>
                                                @endadmin
                                                @break
                                            @case(4)
                                                @admin
                                                    <a href="{{ route('admin.orders.update-in-production', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover-bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Update Status to In Production
                                                    </a>
                                                @endadmin
                                                @break
                                            @case(5)
                                                @admin
                                                    <a href="{{ route('admin.orders.upload-in-production', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload Production Progress Images
                                                    </a>
                                                    <a href="{{ route('admin.orders.update-finished', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Update Status to Production Completed
                                                    </a>
                                                @endadmin
                                                @break
                                            @case(6)
                                                @admin
                                                    <a href="{{ route('admin.orders.upload-finished', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover-bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload Finished Product Images
                                                    </a>
                                                    @if($p->progress->lab_test_document == null)
                                                        <a href="{{ route('admin.orders.upload-test-lab', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover-bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                            Upload Necessary Lab Test Documents
                                                        </a>
                                                    @endif
                                                @endadmin
                                                @break
                                            @case(7)
                                                @customer
                                                    @if($p->progress->lab_test_document != null)
                                                    <a href="{{ route('orders.upload-2nd-term', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover-bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload 2nd Term Payment Proof
                                                    </a>
                                                    @endif
                                                @endcustomer
                                            @break
                                            @case(8)
                                                @admin
                                                    <a href="{{ route('admin.orders.upload-2nd-invoice', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload 2nd Term Invoice
                                                    </a>
                                                @endadmin
                                                @break
                                            @case(9)
                                                @admin
                                                    <a href="{{ route('admin.orders.upload-packing', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload Product Packing Images
                                                    </a>
                                                    <a href="{{ route('admin.orders.upload-shipping', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload Shipping Document
                                                    </a>
                                                @endadmin
                                                @break
                                            @case(10)
                                                @customer
                                                    <a href="{{ route('orders.upload-3rd-term', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload 3rd Term Payment Proof
                                                    </a>
                                                @endcustomer
                                                @break
                                            @case(11)
                                                @admin
                                                    <a href="{{ route('admin.orders.upload-3rd-invoice', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload 3rd Term Invoice
                                                    </a>
                                                @endadmin
                                                @break
                                            @case(12)
                                                @admin
                                                    <a href="{{ route('admin.orders.upload-container', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload Product Container Images
                                                    </a>
                                                    <a href="{{ route('admin.orders.upload-bill-of-lading', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Upload Bill of Lading
                                                    </a>
                                                @endadmin
                                                @break
                                            @case(13)
                                                @admin
                                                    <a href="{{ route('admin.orders.update-arrived', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Update Status to Arrived
                                                    </a>
                                                @endadmin
                                                @break
                                            @case(14)
                                                @customer
                                                    <a href="{{ route('orders.update-completed', $p->id) }}" class="inline-flex items-center rounded-md border border-green-300 bg-green-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-green-700 shadow-sm transition duration-150 ease-in-out hover-bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25">
                                                        Complete the Transaction
                                                    </a>
                                                @endcustomer
                                                @break
                                            @default
                                        @endswitch
                                        @admin
                                            <a href="{{ route('admin.orders.show', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover-bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                Show Order
                                            </a>
                                        @else
                                            <a href="{{ route('orders.show', $p->id) }}" class="inline-flex items-center rounded-md border border-blue-300 bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 shadow-sm transition duration-150 ease-in-out hover-bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25">
                                                Show Order
                                            </a>
                                        @endadmin
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
