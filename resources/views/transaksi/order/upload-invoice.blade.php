<x-app-layout>
    <x-slot name="title">
        {{ __('Upload ' . $title . ' Term Invoice') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Upload ' . $title . ' Term Invoice') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route($routeName, $orders->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-input-label for="dokumen_bukti_pembayaran" value="View receipt of payment." />
                            <a href="{{ $orders->pembayaran->tempUrl }}" target="_blank"
                                class="mt-1 mb-1 px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900"
                                rel="noopener noreferrer">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="12px">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                View Receipt of Payment</a>

                            <div>
                                <x-input-label for="invoice" value="Upload Invoice" />
                                <input id='invoice' name='invoice' type='file'
                                    class='block mt-1 w-full file-input  file-input-bordered file-input-primary bg-white max-w-xs' />
                                <x-input-error :messages="$errors->get('invoice')" class="mt-2" />
                            </div>

                            <div>
                                <button type="submit"
                                    class="mt-4 bg-indigo-500 text-white py-2 px-4 rounded hover:bg-indigo-600 transition duration-150 ease-in-out">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

