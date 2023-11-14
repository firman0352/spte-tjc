<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.3s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Verification List') }}
        </h2>
    </x-slot>
    <!-- Modal -->
    <x-verif-details-modal>
        <x-slot name="customContent">
            <p class="mb-2 text-black text-lg font-bold">Inspectors</p>
            <p class="mb-2 text-black"><strong class="text-gray-400">Inspector I :</strong> <span
                    id="inspector1/address">Inspector I Name</span></p>
            <p class="mb-2 text-black"><strong class="text-gray-400">Inspector II :</strong> <span
                    id="inspector2/phone">Inspector II Name</span></p>
        </x-slot>
    </x-verif-details-modal>

    <div>
        <div class="max-w-full px-4">
            <div class="flex justify-between">
                <div class="flex gap-2 mb-4">
                    <!-- Filter button for multiple status options -->
                    <span class="text-black font-bold">Status</span>
                    <x-filter-button href="{{ route('verifikasi.index', ['status_ids' => []]) }}" :active="!request()->has('status_ids')">
                        All
                    </x-filter-button>

                    <x-filter-button href="{{ route('verifikasi.index', ['status_ids' => [6, 7]]) }}" :active="request()->has('status_ids') &&
                        (in_array(6, request()->input('status_ids')) || in_array(7, request()->input('status_ids')))">
                        Ongoing
                    </x-filter-button>

                    <x-filter-button href="{{ route('verifikasi.index', ['status_ids' => [3]]) }}" :active="request()->has('status_ids') && in_array(3, request()->input('status_ids'))">
                        Success
                    </x-filter-button>

                    <x-filter-button href="{{ route('verifikasi.index', ['status_ids' => [4, 5]]) }}" :active="request()->has('status_ids') &&
                        (in_array(4, request()->input('status_ids')) || in_array(5, request()->input('status_ids')))">
                        Not successful
                    </x-filter-button>

                </div>
                <a href="{{ route('verifikasi.index', ['status_ids' => []]) }}" class="text-indigo-500 font-bold">Reset
                    Filter</a>
            </div>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">

                    <div class="min-w-full align-middle">
                        <table id="listTable" class=" nowrap hover compact">
                            <thead>
                                <tr>
                                    <th class="bg-transparant px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Company
                                            Name</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Inspector
                                            I</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Inspector
                                            II</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Status</span>
                                    </th>
                                    <th class="w-56 bg-transparant px-6 py-3 text-left dt-head-center">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black ">Action</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach ($verifikasi as $item)
                                    <tr class="bg-white">
                                        <td
                                            class="px-6 py-4 text-sm font-semibold leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            {{ $item->dokumenCustomer->nama_pt }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            {{ $item->inspektur->user->name ?? '' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            {{ $item->inspektur2->user->name ?? '' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            <x-status-badge :status_id="$item->status_id" :status="$item->statusDokumen->status" />
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center w-1/5">
                                            <form action="{{ route('verifikasi.destroy', $item) }}" method="POST"
                                                data-id="{{ $item->id }}" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="delete-button inline-flex text-red-500 items-center px-2 py-2 hover:text-red-700 disabled:opacity-25">
                                                    <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true" width="25px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                            <button
                                                class="view-detail-button inline-flex text-gray-500 items-center px-2 py-2 hover:text-black disabled:opacity-25"
                                                data-id="{{ $item }}"
                                                data-nama_pt="{{ $item->dokumenCustomer->nama_pt }}"
                                                data-status="{{ $item->statusDokumen->status }}"
                                                data-inspektur-adress="{{ $item->inspektur->user->name ?? '' }}"
                                                data-inspektur2-phone="{{ $item->inspektur2->user->name ?? '' }}"
                                                data-start="{{ $item->tanggal_mulai }}"
                                                data-end="{{ $item->tanggal_selesai }}"
                                                data-status-id="{{ $item->status_id }}"
                                                data-url="{{ $item->dokumenCustomer->getTempUrl($item->dokumenCustomer->dokumen) }}">
                                                <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" width="25px">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </button>
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
    <script type="text/javascript" src="{{ URL::asset('/verif-details.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/delete-confirm.js') }}"></script>
</x-app-layout>
