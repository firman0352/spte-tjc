<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Verification Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold mb-4">{{ $verifikasi->dokumenCustomer->nama_pt }}</h1>
                    
                    <p class="mb-2"><strong>Alamat PT:</strong> {{ $verifikasi->dokumenCustomer->alamat_pt }}</p>
                    <p class="mb-2"><strong>Status:</strong> {{ $verifikasi->statusDokumen->status }}</p>
                    
                    @if ($verifikasi->dokumenCustomer->dokumen)
                        <a href="{{ $verifikasi->dokumenCustomer->getTempUrl($verifikasi->dokumenCustomer->dokumen) }}" target="_blank" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                            View Dokumen
                        </a>
                    @else
                        <p class="text-gray-500">No Dokumen Available</p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('inspektur.verifikasi.index') }}" class="text-indigo-600 hover:underline">Back</a>
                    </div>

                    <form method="post" action="{{ route('inspektur.verifikasi.approve', ['verifikasi' => $verifikasi]) }}">
                        @csrf
                        @method('patch')
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-black font-semibold px-4 py-2 rounded-md">Approve</button>
                    </form>

                    <button onclick="openModal()" style="background: #f00; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer;">Tolak</button>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Modal -->
<div id="myModal" style="display: none; position: absolute; top: 0; left: 0; background: rgba(0, 0, 0, 0.5); width: 100%; height: 100%; z-index: 1;">
    <div style="background: white; width: 60%; margin: 10% auto; padding: 20px; border: 1px solid #888; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <span onclick="closeModal()" style="color: #aaa; float: right; font-size: 28px; cursor: pointer;">&times;</span>
        <form method="post" action="{{ route('inspektur.verifikasi.reject', ['verifikasi' => $verifikasi]) }}">
            @csrf
            @method('patch')
            <input type="text" name="comment" placeholder="Comment" style="border: 1px solid #ccc; padding: 10px; margin: 10px 0; width: 100%;">
            <button type="submit" style="background: #f00; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer;">Tolak</button>
            <button type="button" onclick="closeModal()" style="background: #ccc; padding: 10px; border: none; border-radius: 4px; cursor: pointer;">Cancel</button>
        </form>
    </div>
</div>

<script>
    function openModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';
    }

    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }
</script>
