<x-app-layout>
    <x-slot name="title">
        {{ __('Make Offer') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Make Offer') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.penawaran-harga.store', $pengajuan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="harga" value="Harga" />
                            <x-text-input id="harga" name="harga" value="{{ $pengajuan->harga }}" type="text"
                                class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="dokumen" value="Dokumen" />
                            <input id='dokumen' name='dokumen' type='file'
                                class='block mt-1 w-full file-input  file-input-bordered file-input-primary bg-white max-w-xs' />
                            <x-input-error :messages="$errors->get('dokumen')" class="mt-2" />
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
