<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Product Orders') }}
        </h2>
    </x-slot>

    <div class="max-w-full px-4">
        @if (session('success'))
            <div class="alert alert-success px-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger px-4 mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div>
        <div class="max-w-full px-4">
            @admin
                <div class="flex justify-between">
                    <div class="flex gap-2 mb-4">
                        <!-- Filter button for multiple status options -->
                        <span class="text-black font-bold">Status</span>
                        <x-filter-button href="{{ route('admin.orders.index', ['status_ids' => []]) }}" :active="!request()->has('status_ids')">
                            All
                        </x-filter-button>

                        <x-filter-button href="{{ route('admin.orders.index', ['status_ids' => range(1, 13)]) }}"
                            :active="request()->has('status_ids') &&
                                (count(request()->input('status_ids')) > 0 &&
                                    !in_array(14, request()->input('status_ids')) &&
                                    !in_array(15, request()->input('status_ids')))">
                            Ongoing
                        </x-filter-button>

                        <x-filter-button href="{{ route('admin.orders.index', ['status_ids' => [14]]) }}" :active="request()->has('status_ids') && in_array(14, request()->input('status_ids'))">
                            Arrived
                        </x-filter-button>

                        <x-filter-button href="{{ route('admin.orders.index', ['status_ids' => [15]]) }}" :active="request()->has('status_ids') && in_array(15, request()->input('status_ids'))">
                            Success
                        </x-filter-button>
                    </div>
                    <a href="{{ route('admin.orders.index', ['status_ids' => []]) }}"
                        class="text-indigo-500 font-bold">Reset
                        Filter</a>
                </div>
            @endadmin
            @customer
                <div class="flex justify-between">
                    <div class="flex gap-2 mb-4">
                        <!-- Filter button for multiple status options -->
                        <span class="text-black font-bold">Status</span>
                        <x-filter-button href="{{ route('orders.index', ['status_ids' => []]) }}" :active="!request()->has('status_ids')">
                            All
                        </x-filter-button>

                        <x-filter-button href="{{ route('orders.index', ['status_ids' => range(1, 13)]) }}"
                            :active="request()->has('status_ids') &&
                                (count(request()->input('status_ids')) > 0 &&
                                    !in_array(14, request()->input('status_ids')) &&
                                    !in_array(15, request()->input('status_ids')))">
                            Ongoing
                        </x-filter-button>

                        <x-filter-button href="{{ route('orders.index', ['status_ids' => [14]]) }}" :active="request()->has('status_ids') && in_array(14, request()->input('status_ids'))">
                            Arrived
                        </x-filter-button>

                        <x-filter-button href="{{ route('orders.index', ['status_ids' => [15]]) }}" :active="request()->has('status_ids') && in_array(15, request()->input('status_ids'))">
                            Success
                        </x-filter-button>
                    </div>
                    <a href="{{ route('admin.orders.index', ['status_ids' => []]) }}"
                        class="text-indigo-500 font-bold">Reset
                        Filter</a>
                </div>
            @endcustomer
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <div class="min-w-full align-middle">
                        <table id="listTable" class=" nowrap hover compact">
                            <thead>
                                <tr>
                                    @admin
                                        <th class="bg-transparant px-6 py-3 text-left w-[10%]">
                                            <span
                                                class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Company
                                                Name</span>
                                        </th>
                                    @endadmin
                                    <th class="bg-transparant px-6 py-3 text-left w-[10%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Product
                                            Name</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left w-[10%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Amount
                                            of Tons</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[20%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Order
                                            Status</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[20%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Documents</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[30%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach ($orders as $p)
                                    <tr class="bg-white">
                                        @admin
                                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                                {{ $p->user->dokumenCustomer->nama_pt }}
                                            </td>
                                        @endadmin
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->penawaran->pengajuan->nama_produk }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->penawaran->pengajuan->jumlah }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center">
                                            <x-status-orders :status="$p->status_order->status" :status_id="$p->status_order_id" />
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center">
                                            @if ($p->progress)
                                                @if ($p->progress->lab_test_document)
                                                    <a href="{{ app('getTempUrl')($p->progress->lab_test_document) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                        LTD
                                                    </a>
                                                @endif

                                                @if ($p->progress->shipping_document)
                                                    <a href="{{ app('getTempUrl')($p->progress->shipping_document) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                        SD
                                                    </a>
                                                @endif

                                                @if ($p->progress->bill_of_lading)
                                                    <a href="{{ app('getTempUrl')($p->progress->bill_of_lading) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                        BOL
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center ">
                                            @switch($p->status_order_id)
                                                @case(1)
                                                    @customer
                                                        <a href="{{ route('orders.upload-kontrak', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload Signed Contract
                                                        </a>
                                                    @endcustomer
                                                @break

                                                @case(2)
                                                    @customer
                                                        <a href="{{ route('orders.upload-1st-term', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload 1st Term Payment Proof
                                                        </a>
                                                    @endcustomer
                                                @break

                                                @case(3)
                                                    @admin
                                                        <a href="{{ route('admin.orders.upload-1st-invoice', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload 1st Term Invoice
                                                        </a>
                                                    @endadmin
                                                @break

                                                @case(4)
                                                    @admin
                                                        <a href="{{ route('admin.orders.update-in-production', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Update Status to In Production
                                                        </a>
                                                    @endadmin
                                                @break

                                                @case(5)
                                                    @admin
                                                        <a href="{{ route('admin.orders.upload-in-production', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload Production Progress Images
                                                        </a>
                                                        <a href="{{ route('admin.orders.update-finished', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Update Status to Production Completed
                                                        </a>
                                                    @endadmin
                                                @break

                                                @case(6)
                                                    @admin
                                                        <a href="{{ route('admin.orders.upload-finished', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload Finished Product Images
                                                        </a>
                                                        @if ($p->progress->lab_test_document == null)
                                                            <a href="{{ route('admin.orders.upload-test-lab', $p->id) }}"
                                                                class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                                <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                    aria-hidden="true" width="12px">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                    </path>
                                                                </svg>
                                                                Upload Necessary Lab Test Documents
                                                            </a>
                                                        @endif
                                                    @endadmin
                                                @break

                                                @case(7)
                                                    @customer
                                                        @if ($p->progress->lab_test_document != null)
                                                            <a href="{{ route('orders.upload-2nd-term', $p->id) }}"
                                                                class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                                <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                    aria-hidden="true" width="12px">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                    </path>
                                                                </svg>
                                                                Upload 2nd Term Payment Proof
                                                            </a>
                                                        @endif
                                                    @endcustomer
                                                @break

                                                @case(8)
                                                    @admin
                                                        <a href="{{ route('admin.orders.upload-2nd-invoice', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload 2nd Term Invoice
                                                        </a>
                                                    @endadmin
                                                @break

                                                @case(9)
                                                    @admin
                                                        <a href="{{ route('admin.orders.upload-packing', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload Product Packing Images
                                                        </a>
                                                        <a href="{{ route('admin.orders.upload-shipping', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload Shipping Document
                                                        </a>
                                                    @endadmin
                                                @break

                                                @case(10)
                                                    @customer
                                                        <a href="{{ route('orders.upload-3rd-term', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload 3rd Term Payment Proof
                                                        </a>
                                                    @endcustomer
                                                @break

                                                @case(11)
                                                    @admin
                                                        <a href="{{ route('admin.orders.upload-3rd-invoice', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload 3rd Term Invoice
                                                        </a>
                                                    @endadmin
                                                @break

                                                @case(12)
                                                    @admin
                                                        <a href="{{ route('admin.orders.upload-container', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload Product Container Images
                                                        </a>
                                                        <a href="{{ route('admin.orders.upload-bill-of-lading', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Upload Bill of Lading
                                                        </a>
                                                    @endadmin
                                                @break

                                                @case(13)
                                                    @admin
                                                        <a href="{{ route('admin.orders.update-arrived', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Update Status to Arrived
                                                        </a>
                                                    @endadmin
                                                @break

                                                @case(14)
                                                    @customer
                                                        <a href="{{ route('orders.update-completed', $p->id) }}"
                                                            class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                            <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" width="12px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                                </path>
                                                            </svg>
                                                            Complete the Transaction
                                                        </a>
                                                    @endcustomer
                                                @break

                                                @default
                                            @endswitch
                                            @admin
                                                <a href="{{ route('admin.orders.show', $p->id) }}"
                                                    class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-lime-100 text-lime-800 gap-1 hover:bg-lime-200 hover:text-lime-900">
                                                    <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true" width="12px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                        </path>
                                                    </svg>
                                                    Order Detail
                                                </a>
                                            @else
                                                <a href="{{ route('orders.show', $p->id) }}"
                                                    class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-lime-100 text-lime-800 gap-1 hover:bg-lime-200 hover:text-lime-900">
                                                    <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true" width="12px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                        </path>
                                                    </svg>
                                                    Show Order
                                                </a>
                                            @endadmin
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <p class="text-xs opacity-40 text-black">*LTD : Laboratory Test Document</p>
                            <p class="text-xs opacity-40 text-black">*SD : Shipping Document</p>
                            <p class="text-xs opacity-40 text-black">*BOL : Bill Of Lading</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

