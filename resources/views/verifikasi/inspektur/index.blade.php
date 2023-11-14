<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Company Document Verification') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">

                    <div class="min-w-full align-middle">
                        <table id="listTable" class=" nowrap hover compact">
                            <thead>
                                <tr>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Company
                                            Name</span>
                                    </th>
                                    @if (auth()->user()->inspektur->jabatan_id == 1)
                                        <th class="bg-gray-50 px-6 py-3 text-left">
                                            <span
                                                class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Second
                                                Inspector</span>
                                        </th>
                                    @elseif(auth()->user()->inspektur->jabatan_id == 2)
                                        <th class="bg-gray-50 px-6 py-3 text-left">
                                            <span
                                                class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Fisrt
                                                Inspector</span>
                                        </th>
                                    @endif
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Status</span>
                                    </th>
                                    <th class="w-56 bg-gray-50 px-6 py-3 text-left dt-head-center">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black ">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach ($verifikasi as $item)
                                    <tr class="bg-white">
                                        <td
                                            class="px-6 py-4 text-sm font-semibold leading-5 text-black whitespace-no-wrap">
                                            {{ $item->dokumenCustomer->nama_pt }}
                                        </td>
                                        @if (auth()->user()->inspektur->jabatan_id == 1)
                                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                                {{ $item->inspektur2->user->name ?? '' }}
                                            </td>
                                        @elseif(auth()->user()->inspektur->jabatan_id == 2)
                                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                                {{ $item->inspektur->user->name ?? '' }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            <x-status-badge :status_id="$item->status_id" :status="$item->statusDokumen->status" />
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center">
                                            <a href="{{ route('inspektur.verifikasi.show', $item) }}"
                                                class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true" width="12px">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                    </path>
                                                </svg>
                                                Verify
                                            </a>
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
