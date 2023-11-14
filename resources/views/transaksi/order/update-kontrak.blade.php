<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Upload Signed Contract') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('orders.update-kontrak', $orders->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="dokumen_kontrak" value="Dokumen Kontrak" />
                            <input id='dokumen_kontrak' name='dokumen_kontrak' type='file' class='block mt-1 w-full' />
                            <x-input-error :messages="$errors->get('dokumen_kontrak')" class="mt-2" />
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
