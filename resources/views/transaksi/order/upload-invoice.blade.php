<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Upload ' .  $title . ' Term Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route($routeName, $orders->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <h1 class="text-3xl font-bold text-center">Review the receipt of payment and upload Invoice</h1>

                        <div>
                            <x-input-label for="dokumen_bukti_pembayaran" value="View receipt of payment." />
                            <a href="{{ $orders->pembayaran->tempUrl }}" target="_blank" rel="noopener noreferrer">View</a>    

                        <div>
                            <x-input-label for="invoice" value="Upload Invoice" />
                            <input id='invoice' name='invoice' type='file' class='block mt-1 w-full' />
                            <x-input-error :messages="$errors->get('invoice')" class="mt-2" />
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
