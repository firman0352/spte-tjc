<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Company Document Detail') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="max-w-full px-4 xl:w-1/2">
            <div class="overflow-hidden bg-white shadow-sm rounded-lg">
                <div class="overflow-hidden bg-white p-6">
                    <!-- Display Success Message -->
                    @if (session('success'))
                        <div class="bg-green-200 text-green-800 p-4 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Display Error Message -->
                    @if (session('error'))
                        <div class="bg-red-200 text-red-800 p-4 mb-4 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($dokumen)
                        <div class="flex justify-between mb-4">
                            <div>
                                <p class="text-xs text-black">Company Name</p>
                                <h1 class="text-md sm:text-xl text-black font-bold">{{ $dokumen->nama_pt }}</h1>
                                <p class="text-xs text-black">Address</p>
                                <h1 class="text-md sm:text-xl text-black font-bold">{{ $dokumen->alamat_pt }}</h1>
                                @if ($comment)
                                    <p class="text-xs text-black">Comment</p>
                                    <h1 class="text-md sm:text-xl text-red-500 font-bold">{{ $comment }}</h1>
                                @endif
                                <p class="text-xs text-black">Created Date</p>
                                <h1 class="text-md sm:text-xl text-black font-bold">{{ $dokumen->created_at }}</h1>
                                @if ($dokumen->verifikasi)
                                    <p class="text-xs text-black">Current Document Position</p>
                                    <h1 class="text-md sm:text-xl text-black font-bold">{{ $dokumen->verifikasi->location ?? '-' }}</h1>
                                @endif
                            </div>
                            <div class="flex flex-col items-start gap-2">
                                <x-status-badge :status_id="$dokumen->status_id" :status="$dokumen->status->status"
                                    class="text-md sm:text-xl bg-orange-100 text-orange-800 rounded-md px-2 font-bold" />
                                @if ($dokumen->status_id == 1 || $dokumen->status_id == 5 || $dokumen->status_id == 4)
                                    <a href="{{ route('dokumen.edit', $dokumen) }}"
                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                        Edit
                                    </a>
                                    <form action="{{ route('dokumen.destroy', $dokumen) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="delete-button inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @if ($dokumen->status_id == 1 || $dokumen->status_id == 5)
                            <form action="{{ route('dokumen.verifikasi', $dokumen) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="button"
                                    class="verify-button inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                    Verify Document
                                </button>
                            </form>
                        @endif
                    @else
                        <p class="label bg-gray-50 px-6 py-2 rounded-md mb-4 w-1/2">No document has been created</p>
                        <a href="{{ route('dokumen.create') }}"
                            class="mb-4 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                            Create
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="max-w-full px-4 xl:w-1/2">
            <div class="overflow-hidden bg-white shadow-sm rounded-lg p-6 flex flex-col items-center">
                <h1 class="text-black font-bold">Verification Progress Details</h1>
                <div>
                    @if (auth()->user()->dokumenCustomer)
                        <ul class="steps steps-vertical text-black">
                            @php
                                $statuses = [
                                    1 => 'Document Uploaded',
                                    2 => 'Document Submitted',
                                    5 => 'Document Revised',
                                    6 => 'A verification request has been made to the Inspectors',
                                    7 => 'Document has been approved',
                                    3 => 'Document has been approved & the document has verified',
                                    4 => 'Document Rejected',
                                    // Add more statuses as needed
                                ];
                            @endphp

                            {{-- Display status logs dynamically --}}
                            @foreach ($statusLogs as $statusLog)
                                <li class="step step-primary">
                                    <div class="items-start flex flex-col">
                                        <p class="text-gray-500 text-sm">
                                            {{ \Carbon\Carbon::parse($statusLog->created_at)->format('F j, Y, H:i') }}
                                            UTC
                                        </p>
                                        <p>
                                            {{ $statuses[$statusLog->status_id] }} by
                                            <strong class="font-bold">{{ $statusLog->user->name }}</strong>
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(event) {
            if (event.target.matches('.delete-button')) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form for deletion
                        event.target.form.submit();
                    }
                });
            }
        });

        // Add an event listener for the "Verify Document" button
        document.addEventListener('click', function(event) {
            if (event.target.matches('.verify-button')) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action will verify the document!',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, verify it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form for verification
                        event.target.form.submit();
                    }
                });
            }
        });
    </script>
</x-app-layout>
