<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Upload Shipping Document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.orders.store-shipping', $orders->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="shipping_document" value="Shipping Document" />
                            <input id='shipping_document' name='shipping_document' type='file' class='block mt-1 w-full' />
                            <x-input-error :messages="$errors->get('shipping_document')" class="mt-2" />
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
