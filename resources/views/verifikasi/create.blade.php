<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Verification') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.verifikasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="dokumen_customer_id"
                                class="block text-gray-700 text-sm font-semibold mb-2">Select Dokumen:</label>
                            <input type="hidden" name="dokumen_customer_id"
                                value="{{ $dokumenCustomers->first()->id }}">
                            <input type="text" name="dokumen_customer_name" id="dokumen_customer_name"
                                class="w-full text-black p-2 border rounded" readonly
                                value="{{ $dokumenCustomers->first()->nama_pt }}">
                        </div>

                        <div class="mb-4">
                            <label for="inspektur_id" class="block text-gray-700 text-sm font-semibold mb-2">Select
                                Inspector 1:</label>
                            <select name="inspektur_id" id="inspektur_id" class="w-full text-black p-2 border rounded">
                                @foreach ($inspektur1 as $inspektur)
                                    <option value="{{ $inspektur->id }}">{{ $inspektur->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="inspektur2_id" class="block text-gray-700 text-sm font-semibold mb-2">Select
                                Inspector 2:</label>
                            <select name="inspektur2_id" id="inspektur2_id"
                                class="w-full text-black p-2 border rounded">
                                @foreach ($inspektur2 as $inspektur)
                                    <option value="{{ $inspektur->id }}">{{ $inspektur->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="status_id" class="block text-gray-700 text-sm font-semibold mb-2">Select
                                Status:</label>
                            <select name="status_id" id="status_id" class="w-full text-black p-2 border rounded">
                                @foreach ($statusDokumens as $statusDokumen)
                                    <option value="{{ $statusDokumen->id }}">{{ $statusDokumen->status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="rfid_tag" class="block text-gray-700 text-sm font-semibold mb-2">Pair
                                RFID Tag:</label>
                            <x-text-input id="rfid_tag" class="block mt-1 w-full" type="text" name="rfid_tag" :value="session('rfid_tag')" readonly required autofocus />
                        </div>

                        <div>
                            <button type="submit"
                                class="bg-indigo-500 text-white py-2 px-4 rounded hover:bg-indigo-600 transition duration-150 ease-in-out">Create
                                Verification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        setInterval(function() {
            $.get('/rfid', function(data) {
                $('#rfid_tag').val(data.rfid_tag);
            });
            console.log(data.rfid_tag); 
        }, 1000); // Check every second
    });
</script>