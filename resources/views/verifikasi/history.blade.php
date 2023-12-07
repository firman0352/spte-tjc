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
    <x-slot name="title">
        {{ __('Verification History List') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Verification History List') }}
        </h2>
    </x-slot>
    <!-- Modal -->
    <x-verif-details-modal>
        <x-slot name="customContent">
            <p class="mb-2 text-black text-lg font-bold">Contact</p>
            <p class="mb-2 text-black"><strong class="text-gray-400">Address:</strong> <span
                    id="inspector1/address">Address</span></p>
            <p class="mb-2 text-black"><strong class="text-gray-400">Phone Number:</strong> <span
                    id="inspector2/phone">Phone</span></p>
        </x-slot>
    </x-verif-details-modal>
    <div>
    </div>
    <div>
        <div class="max-w-full px-4">
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
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Address</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Phone
                                            Number</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Status</span>
                                    </th>
                                    <th class="w-56 bg-transparant px-6 py-3 text-left dt-head-center">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black ">View</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach ($verifikasi as $item)
                                    <tr class="bg-white">
                                        <td
                                            class="px-6 py-4 text-sm font-semibold leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            {{ $item->nama_pt }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            {{ $item->alamat_pt ?? '' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            {{ $item->user->phone ?? '' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            <x-status-badge :status_id="$item->status_id" :status="$item->status->status" />
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center w-1/5">
                                            <button
                                                class="view-detail-button inline-flex text-gray-500 items-center px-2 py-2 hover:text-black disabled:opacity-25"
                                                data-id="{{ $item->id }}" data-nama_pt="{{ $item->nama_pt }}"
                                                data-status="{{ $item->status->status }}"
                                                data-inspektur-adress="{{ $item->alamat_pt ?? '' }}"
                                                data-inspektur2-phone="{{ $item->user->phone ?? '' }}"
                                                data-start="{{ $item->verifikasi ? $item->verifikasi->tanggal_mulai : '' }}"
                                                data-end="{{ $item->verifikasi ? $item->verifikasi->tanggal_selesai : '' }}"
                                                data-status-id="{{ $item->status_id }}"
                                                data-url="{{ $item->getTempUrl($item->dokumen) }}">
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
</x-app-layout>
