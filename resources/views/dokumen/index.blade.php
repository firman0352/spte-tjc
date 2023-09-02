<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail Dokumen') }}
        </h2>
    </x-slot>
 
    <div >
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
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
                                    <td class="label bg-gray-50 px-6 py-2">Nama Perusahaan</td><td>:</td>
                                    <td class="px-1 py-2">{{ $dokumen->nama_pt }}</td>
                                </tr>
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2">Alamat Perusahaan</td><td>:</td>
                                    <td class="px-1 py-2">{{ $dokumen->alamat_pt }}</td>
                                </tr>
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2">No Telepon</td><td>:</td>
                                    <td class="px-1 py-2">{{ $dokumen->no_telp }}</td>
                                </tr>
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2">Dokumen</td><td>:</td>
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
                                <tr>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
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
                                    </td>
                                </tr>
                                <!-- Tambahkan field lain sesuai kebutuhan sebagai baris tambahan -->
                            @else
                                <tr>
                                    <td class="label bg-gray-50 px-6 py-2" colspan="2">Anda belum memiliki dokumen.</td>
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
