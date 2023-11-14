<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Request Product Specification') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <form method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="nama_produk" value="Product Name" />
                            <select name="nama_produk" id="nama_produk"
                                class="block mt-1 w-full text-black border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Product</option>
                                <option value="Coconut Bricket">Coconut Bricket</option>
                                <option value="Coconut Fiber">Coconut Fiber</option>
                                <option value="Crude Palm Oil">Crude Palm Oil</option>
                                <option value="Coco Peat">Coco Peat</option>
                                <!-- Add more options as needed -->
                            </select>
                            <x-input-error :messages="$errors->get('nama_produk')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="jumlah" value="Amount (tons)" />
                            <x-text-input type="text" name="jumlah" id="jumlah" value="{{ old('jumlah') }}"
                                class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="dokumen" value="Specification Product Document" />
                            <x-text-input type="file" name="dokumen" id="dokumen" class="block mt-1 w-full"
                                required />
                            <x-input-error :messages="$errors->get('dokumen')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-primary-button>
                                Submit
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
