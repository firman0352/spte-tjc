<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.orders.store', $penawaran) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="dokumen_kontrak" value="Dokumen Kontrak" />
                            <input id='dokumen_kontrak' name='dokumen_kontrak' type='file' class='block mt-1 w-full' />
                            <x-input-error :messages="$errors->get('dokumen_kontrak')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="pembayaran_term1" value="Pembayaran Term 1" />
                            <x-text-input id="pembayaran_term1" name="pembayaran_term1" value="{{ old('pembayaran_term1') }}" type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('pembayaran_term1')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="pembayaran_term2" value="Pembayaran Term 2" />
                            <x-text-input id="pembayaran_term2" name="pembayaran_term2" value="{{ old('pembayaran_term2') }}" type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('pembayaran_term2')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="pembayaran_term3" value="Pembayaran Term 3" />
                            <x-text-input id="pembayaran_term3" name="pembayaran_term3" value="{{ old('pembayaran_term3') }}" type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('pembayaran_term3')" class="mt-2" />
                        </div>

                        <div>
                            <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded hover:bg-indigo-600 transition duration-150 ease-in-out">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
