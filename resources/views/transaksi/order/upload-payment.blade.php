<x-app-layout>
    <x-slot name="title">
        {{ __('Upload ' . $title . ' Receipt of Payment') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Upload ' . $title . ' Receipt of Payment') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route($routeName, $orders->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="bukti_pembayaran"
                                value="Please upload {{ $title }} receipt of payment with the contract-specified amount." />
                            <input id='bukti_pembayaran' name='bukti_pembayaran' type='file'
                                class='block mt-1 w-full file-input  file-input-bordered file-input-primary bg-white max-w-xs' />
                            <x-input-error :messages="$errors->get('bukti_pembayaran')" class="mt-2" />
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

