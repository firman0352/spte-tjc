<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Price Offer Details') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-full px-4 w-1/2">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between lg:flex-row flex-col">
                        <h1 class="text-2xl lg:text-4xl font-semibold text-black">
                            {{ $penawaran->pengajuan->user->dokumenCustomer->nama_pt }}</h1>
                        <x-status-multiple :status="$penawaran->status->status" :status_id="$penawaran->status_id" />
                    </div>
                    <div class="w-full h-[2px] bg-indigo-500 my-2 opacity-50"></div>

                    <p class="mb-2 text-black"><strong class="text-gray-400">Product Name:</strong>
                        {{ $penawaran->pengajuan->nama_produk }}</p>
                    <p class="mb-2 text-black"><strong class="text-gray-400">Amount of Product:</strong>
                        {{ $penawaran->pengajuan->jumlah }} Tons</p>
                    <p class="mb-2 text-black"><strong class="text-gray-400">Price:</strong>
                        ${{ number_format(floatval($penawaran->harga), 2, '.', ',') }} / Tons</p>
                    <p class="mb-2 text-black"><strong class="text-gray-400">Status:</strong>
                        {{ $penawaran->status->status }}</p>
                    @php
                        $total = floatval($penawaran->pengajuan->jumlah) * floatval($penawaran->harga);
                        $formattedTotal = number_format($total, 2, '.', ',');
                    @endphp
                    <p class="mb-2 text-black"><strong class="text-gray-400">Total:</strong> ${{ $formattedTotal }}</p>
                    @if ($penawaran->keterangan)
                        @if ($penawaran->status_id == 4 || $penawaran->status_id == 5)
                            <p class="mb-2 text-red-500"><strong class="text-red-500">Offer Complaint:</strong>
                                {{ $penawaran->keterangan }}</p>
                        @endif
                    @endif
                    <div class="flex gap-4 mt-10">
                        @if (auth()->user()->roleName() == 'customer')
                            <form method="post" action="{{ route('penawaran-harga.approve', $penawaran->id) }}">
                                @csrf
                                @method('patch')
                                <button type="submit"
                                    class="px-2 py-0 inline-flex items-center text-sm lg:text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800 gap-1 hover:bg-green-200 hover:text-green-900">Approve</button>
                            </form>
                            <form method="post" action="{{ route('penawaran-harga.reject', $penawaran->id) }}"
                                data-penawaran-id="{{ $penawaran->id }}">
                                @csrf
                                @method('patch')
                                <button type="button"
                                    class="reject-button px-2 py-0 inline-flex items-center text-sm lg:text-lg leading-5 font-semibold rounded-full bg-red-100 text-red-800 gap-1 hover:bg-red-200 hover:text-red-900">Reject</button>
                            </form>

                            <button onclick="openModal()"
                                class="px-2 py-0 inline-flex items-center text-sm lg:text-lg leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 gap-1 hover:bg-indigo-200 hover:text-indigo-900">Negotiate</button>
                        @elseif(auth()->user()->roleName() == 'admin')
                            @if ($penawaran->status_id == 4)
                                <a href="{{ route('admin.penawaran-harga.edit', $penawaran->id) }}"
                                    class="px-2 py-0 inline-flex items-center text-sm lg:text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800 gap-1 hover:bg-green-200 hover:text-green-900">Offer
                                    New Penawaran</a>

                                <form method="post"
                                    action="{{ route('admin.penawaran-harga.reject', $penawaran->id) }}">
                                    @csrf
                                    @method('patch')
                                    <button type="submit"
                                        class="px-2 py-0 inline-flex items-center text-sm lg:text-lg leading-5 font-semibold rounded-full bg-red-100 text-red-800 gap-1 hover:bg-red-200 hover:text-red-900">Reject
                                        offer</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Modal -->
<div id="myModal"
    style="display: none; position: absolute; top: 0; left: 0; background: rgba(0, 0, 0, 0.5); width: 100%; height: 100%; z-index: 50; transition: opacity 0.3s ease-in-out;">
    <div class="rounded-lg"
        style="background: white; width: 60%; margin: 10% auto; padding: 20px; border: 1px solid #888; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <span onclick="closeModal()" style="color: #aaa; float: right; font-size: 28px; cursor: pointer;">&times;</span>
        <h1>Negotiate</h1>
        <form method="post" action="{{ route('penawaran-harga.negotiate', $penawaran->id) }}">
            @csrf
            @method('patch')
            <input type="text" name="keterangan" placeholder="Comment to offer"
                style="border: 1px solid #ccc; padding: 10px; margin: 10px 0; width: 100%;"
                class="rounded-md text-black" required>
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Negotiate</button>
            <button type="button" onclick="closeModal()"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancel</button>
        </form>
    </div>
</div>

<script>
    function openModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';

        // Trigger a reflow to enable the transition
        void modal.offsetWidth;

        modal.style.opacity = '1';
    }

    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.opacity = '0';

        // Add a delay before hiding the modal to allow the transition to complete
        setTimeout(function() {
            modal.style.display = 'none';
        }, 300); // 300 milliseconds is the duration of the transition
    }


    // Select all buttons with the decline-button class
    const declineButtons = document.querySelectorAll('.reject-button');

    declineButtons.forEach(button => {
        button.addEventListener('click', function() {
            const penawaranId = this.parentElement.getAttribute('data-penawaran-id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.querySelector(
                        `form[data-penawaran-id="${penawaranId}"]`);
                    form.submit();
                }
            });
        });
    });
</script>
