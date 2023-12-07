<style>
    .transition-opacity {
        transition: opacity 0.3s;
        /* Adjust the duration as needed */
    }
</style>
<x-app-layout>
    <x-slot name="title">
        {{ __('Profuct Specification Submission List') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Product Specification Submission') }}
        </h2>
    </x-slot>

    <div class="max-w-full px-4">
        @if (session('success'))
            <div class="alert alert-success px-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger px-4 mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div>
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <div class="min-w-full align-middle">
                        <table id="listTable" class=" nowrap hover compact">
                            <thead>
                                <tr>
                                    <th class="bg-transparant px-6 py-3 text-left w-[10%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Company
                                            Name</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left w-[10%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Product
                                            Name</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left w-[10%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Amount
                                            of Tons</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[15%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Submission
                                            Status</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[15%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Offering
                                            Status</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[20%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Document</span>
                                    </th>
                                    <th class="bg-transparant px-6 py-3 text-left dt-head-center w-[20%]">
                                        <span
                                            class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach ($pengajuan as $p)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->user->dokumenCustomer->nama_pt }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->nama_produk }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $p->jumlah }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center">
                                            <x-status-multiple :status_id="$p->status_id" :status="$p->statusPengajuan->status" />
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center">
                                            @if ($p->penawaranHarga)
                                                <x-status-multiple :status_id="$p->penawaranHarga->status_id" :status="$p->penawaranHarga->status->status" />
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap dt-body-center">
                                            <a href="{{ $p->tempUrl }}" target="_blank"
                                                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                SPD
                                            </a>
                                            @if ($p->penawaranHarga)
                                                @if ($p->penawaranHarga->dokumen)
                                                    <a href="{{ $p->penawaranHarga->getTempUrl($p->penawaranHarga->dokumen) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                        FOD
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->status_id == 1)
                                                <button data-pengajuan-id="{{ $p->id }}"
                                                    class="pengajuan-modal-button px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                    <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true" width="12px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                        </path>
                                                    </svg>
                                                    Price the Product
                                                </button>
                                            @endif
                                            @if ($p->penawaranHarga)
                                                @if ($p->penawaranHarga->status_id == 2 && $p->penawaranHarga->dokumen == null)
                                                    <button data-penawaran-id="{{ $p->penawaranHarga->id }}"
                                                        class="add-final-document-modal-button px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                        <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                            aria-hidden="true" width="12px">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                            </path>
                                                        </svg>
                                                        Add Final Offering Document
                                                    </button>
                                                @endif
                                                <a href="{{ route('admin.penawaran-harga.show', $p->penawaranHarga->id) }}"
                                                    class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-lime-100 text-lime-800 gap-1 hover:bg-lime-200 hover:text-lime-900">
                                                    <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true" width="12px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                        </path>
                                                    </svg>
                                                    Price Offer Details
                                                </a>
                                                @if ($p->penawaranHarga->status_id == 2 && $p->penawaranHarga->dokumen != null && $p->penawaranHarga->orders == null)
                                                    <a href="{{ route('admin.orders.create', $p->penawaranHarga->id) }}"
                                                        class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                                        <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                            aria-hidden="true" width="12px">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                            </path>
                                                        </svg>
                                                        Process Orders
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <p class="text-xs opacity-40 text-black">*SPD : Specific Product Document</p>
                            <p class="text-xs opacity-40 text-black">*FOD : Final Offer Document</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- process pengajuan modal -->
    <div id="processPengajuanModal"
        class="fixed inset-0 flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <!-- Modal overlay -->
        <div id="modal-overlay" class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <!-- Modal container -->
        <div
            class="modal-container bg-white w-11/12 md:max-w-lg mx-auto rounded-lg shadow-lg z-50 overflow-y-auto transition-opacity">
            <!-- Modal content -->
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-bold">Price the Product</p>
                    <div class="modal-close cursor-pointer z-50" onclick="closeProcessPengajuanModal()">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div id="modal-body">
                    <!-- Content for processing pengajuan -->
                    <!-- Your form and content here -->
                    <!-- Form for processing pengajuan -->
                    <form id="approveForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <!-- ... Your form fields here ... -->
                        <x-input-label for="harga" value="Price per Tons" />
                        <x-text-input id="harga" name="harga" type="text" class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />

                        <!-- Add an input field to capture the pengajuan ID -->
                        <input id="pengajuanInput" type="hidden" name="pengajuan_id" value="">

                        <div class="mt-4">
                            <x-primary-button>
                                Approve
                            </x-primary-button>
                        </div>
                    </form>

                    <form id="rejectForm" method="POST" action="">
                        @csrf
                        @method('PATCH')

                        <!-- ... Your form fields here ... -->
                        <!-- Add an input field to capture the pengajuan ID -->
                        <input id="pengajuanInput" type="hidden" name="pengajuan_id" value="">

                        <div class="mt-4">
                            <x-danger-button class="justify-center mt-1 w-full">
                                Reject
                            </x-danger-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Final Offering Document Modal -->
    <div id="addFinalDocumentModal"
        class="fixed inset-0 flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <!-- Modal overlay -->
        <div id="modal-overlay-final" class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <!-- Modal container -->
        <div
            class="modal-container bg-white w-11/12 md:max-w-lg mx-auto rounded-lg shadow-lg z-50 overflow-y-auto transition-opacity">
            <!-- Modal content -->
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-bold">Add Final Offering Document</p>
                    <div class="modal-close cursor-pointer z-50" onclick="closeAddFinalDocumentModal()">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div id="modal-body-final">
                    <!-- Content for adding final offering document -->
                    <!-- Your form and content here -->
                    <!-- Form for adding final offering document -->
                    <form id="addFinalDocumentForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- ... Your form fields here ... -->
                        <x-input-label for="dokumen" value="Dokumen" />
                        <input id="dokumen" name="dokumen" type="file"
                            class='block mt-1 w-full file-input  file-input-bordered file-input-primary bg-white max-w-xs' />
                        <x-input-error :messages="$errors->get('dokumen')" class="mt-2" />

                        <input type="hidden" id="penawaranIdInput" name="penawaran_id" value="">

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

    <script>
        // Function to open the "Process Pengajuan" modal
        function openProcessPengajuanModal(pengajuanId) {
            const modal = document.getElementById('processPengajuanModal');
            const approveModalForm = document.getElementById('approveForm'); // Find the form within the modal
            const rejectModalForm = document.getElementById('rejectForm'); // Find the form within the modal
            const hiddenInput = document.getElementById('pengajuanInput'); // Find the hidden input

            // Set the action attribute of the form with the correct action
            approveModalForm.action = "{{ route('admin.pengajuan.approve', '') }}" + '/' + pengajuanId;
            rejectModalForm.action = "{{ route('admin.pengajuan.reject', '') }}" + '/' + pengajuanId;

            // Set the hidden input value with the pengajuanId
            hiddenInput.value = pengajuanId;
            modal.classList.remove('hidden'); // Remove the "hidden" class

            // Add the "transition-opacity" class to enable opacity transition
            setTimeout(function() {
                modal.classList.add('transition-opacity');
                modal.style.opacity = '1';
            }, 10); // Delay is added to ensure smooth transition
        }

        // Function to close the "Process Pengajuan" modal
        function closeProcessPengajuanModal() {
            const modal = document.getElementById('processPengajuanModal');
            modal.style.opacity = '0';

            // Remove the "transition-opacity" class after the transition
            setTimeout(function() {
                modal.classList.remove('transition-opacity');
                modal.classList.add('hidden'); // Add the "hidden" class to hide the modal
            }, 300); // Adjust the duration to match your transition duration
        }

        // Select all buttons with the class "pengajuan-modal-button"
        var pengajuanButtons = document.querySelectorAll('.pengajuan-modal-button');

        // Add a click event listener to each button
        pengajuanButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Get the pengajuan ID from the button's data attribute
                var pengajuanId = button.getAttribute('data-pengajuan-id');

                // Open the "Process Pengajuan" modal with the pengajuan ID
                openProcessPengajuanModal(pengajuanId);
            });
        });

        // Close the modal when clicking outside of it
        const modalOverlay = document.getElementById('modal-overlay');
        modalOverlay.addEventListener('click', function(event) {
            if (event.target === modalOverlay) {
                closeProcessPengajuanModal();
            }
        });


        // Function to open the "Add Final Offering Document" modal
        function openAddFinalDocumentModal(penawaranId) {
            const modal = document.getElementById('addFinalDocumentModal');
            const addFinalDocumentForm = document.getElementById('addFinalDocumentForm'); // Find the form within the modal
            const hiddenInputFinal = document.getElementById('penawaranIdInput'); // Find the hidden input

            // Set the action attribute of the form with the correct action
            addFinalDocumentForm.action = "{{ route('admin.penawaran-harga.final.store', '') }}" + '/' + penawaranId;

            // Set the hidden input value with the penawaranId
            hiddenInputFinal.value = penawaranId;
            modal.classList.remove('hidden'); // Remove the "hidden" class

            // Add the "transition-opacity" class to enable opacity transition
            setTimeout(function() {
                modal.classList.add('transition-opacity');
                modal.style.opacity = '1';
            }, 10); // Delay is added to ensure smooth transition
        }

        // Function to close the "Add Final Offering Document" modal
        function closeAddFinalDocumentModal() {
            const modal = document.getElementById('addFinalDocumentModal');
            modal.style.opacity = '0';

            // Remove the "transition-opacity" class after the transition
            setTimeout(function() {
                modal.classList.remove('transition-opacity');
                modal.classList.add('hidden'); // Add the "hidden" class to hide the modal
            }, 300); // Adjust the duration to match your transition duration
        }

        // Select all buttons with the class "add-final-document-modal-button"
        var addFinalDocumentButtons = document.querySelectorAll('.add-final-document-modal-button');

        // Add a click event listener to each button
        addFinalDocumentButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Get the penawaran ID from the button's data attribute
                var penawaranId = button.getAttribute('data-penawaran-id');

                // Open the "Add Final Offering Document" modal with the penawaran ID
                openAddFinalDocumentModal(penawaranId);
            });
        });

        // Close the modal when clicking outside of it
        const modalOverlayFinal = document.getElementById('modal-overlay-final');
        modalOverlayFinal.addEventListener('click', function(event) {
            if (event.target === modalOverlayFinal) {
                closeAddFinalDocumentModal();
            }
        });
    </script>

</x-app-layout>

