<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail Document') }}
        </h2>
    </x-slot>
 
    <div >
        <div class="max-w-full px-4">
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

                    <table>
                        <tbody>
                            @if ($dokumen)
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2">Company Name</td><td>:</td>
                                    <td class="px-1 py-2">{{ $dokumen->nama_pt }}</td>
                                </tr>
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2">Company Address</td><td>:</td>
                                    <td class="px-1 py-2">{{ $dokumen->alamat_pt }}</td>
                                </tr>
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2">Phone Number</td><td>:</td>
                                    <td class="px-1 py-2">{{ $dokumen->no_telp }}</td>
                                </tr>
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2">Document</td><td>:</td>
                                    <td class="px-1 py-2">
                                        <a href="{{ $tempUrl }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Lihat Dokumen</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2">Tanggal Upload</td><td>:</td>
                                    <td class="px-1 py-2">{{ $dokumen->created_at }}</td>
                                </tr>
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2">Status</td><td>:</td>
                                    <td class="px-1 py-2">{{ $dokumen->status->status }}</td>
                                </tr>
                                @if($comment)
                                    <tr>
                                        <td class="label bg-gray-50 px-6 py-2">Comment</td><td>:</td>
                                        <td class="px-1 py-2">{{ $comment }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        @if ($dokumen->status_id == 1)
                                            <form action="{{ route('dokumen.verifikasi', $dokumen) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <x-danger-button>
                                                    Verifikasi Dokumen
                                                </x-danger-button>
                                            </form>
                                        @endif
                                        @if ($dokumen->status_id == 1 || $dokumen->status_id == 5 || $dokumen->status_id == 4)
                                        <a href="{{ route('dokumen.edit', $dokumen) }}"
                                           class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                            Edit
                                        </a>
                                        <form action="{{ route('dokumen.destroy', $dokumen) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button>
                                                Delete
                                            </x-danger-button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Tambahkan field lain sesuai kebutuhan sebagai baris tambahan -->
                            @else
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2" colspan="2">No document has been created</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap" colspan="2">
                                        <a href="{{ route('dokumen.create') }}"
                                           class="mb-4 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                            Create
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
