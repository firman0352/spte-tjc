<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Document') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Use PUT method for updates --}}

                        <div>
                            <x-input-label for="nama_pt" value="Company Name" />
                            <x-text-input id="nama_pt" name="nama_pt" value="{{ $dokumen->nama_pt }}" type="text"
                                class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('nama_pt')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="alamat_pt" value="Company Address" />
                            <x-text-input id="alamat_pt" name="alamat_pt" value="{{ $dokumen->alamat_pt }}"
                                type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('alamat_pt')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="no_telp" value="Phone Number" />
                            <x-text-input id="no_telp" name="no_telp" value="{{ $dokumen->no_telp }}" type="tel"
                                class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="dokumen" value="Document" />
                            <input id="file" name="file" type="file" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                Update
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
