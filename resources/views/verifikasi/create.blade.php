<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Verification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.verifikasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="dokumen_customer_id" class="block text-gray-700 text-sm font-semibold mb-2">Select Dokumen:</label>
                            <select name="dokumen_customer_id" id="dokumen_customer_id" class="w-full p-2 border rounded">
                                @foreach ($dokumenCustomers as $dokumenCustomer)
                                    <option value="{{ $dokumenCustomer->id }}">{{ $dokumenCustomer->nama_pt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="inspektur_id" class="block text-gray-700 text-sm font-semibold mb-2">Select Inspektur:</label>
                            <select name="inspektur_id" id="inspektur_id" class="w-full p-2 border rounded">
                                @foreach ($inspekturs as $inspektur)
                                    <option value="{{ $inspektur->id }}">{{ $inspektur->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="status_id" class="block text-gray-700 text-sm font-semibold mb-2">Select Status:</label>
                            <select name="status_id" id="status_id" class="w-full p-2 border rounded">
                                @foreach ($statusDokumens as $statusDokumen)
                                    <option value="{{ $statusDokumen->id }}">{{ $statusDokumen->status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_mulai" class="block text-gray-700 text-sm font-semibold mb-2">Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full p-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_selesai" class="block text-gray-700 text-sm font-semibold mb-2">Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full p-2 border rounded">
                        </div>

                        <div>
                            <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded hover:bg-indigo-600 transition duration-150 ease-in-out">Create Verification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
