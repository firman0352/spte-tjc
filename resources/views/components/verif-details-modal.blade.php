<div id="detailModal" class="fixed inset-0 flex items-center justify-center z-50 hidden transition-opacity duration-300">
    <!-- ... Modal content ... -->
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-lg mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <!-- Add your modal content here -->
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-bold">Details</p>
                    <div class="modal-close cursor-pointer z-50">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div id="modal-body">
                    <div class="flex items-center justify-between lg:flex-row flex-col">
                        <h1 class="text-2xl lg:text-4xl font-semibold text-black" id="companyName">Company Name</h1>
                        <span class="px-2 py-0 lg:py-1 inline-flex text-xs lg:text-md leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800" id="status">Status</span>
                    </div>
                    <div class="w-full h-[2px] bg-indigo-500 my-2 opacity-50"></div>
                    <div class="flex justify-between">
                        <div>
                            {{$customContent ?? ''}}
                        </div>
                        <div>
                            <a href="#" target="_blank" id="url-view" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                View Document
                            </a>
                        </div>
                    </div>
                    <p class="mb-2 text-black text-lg font-bold">Time</p>
                    <div class="flex justify-between items-center">
                        <p class="text-black"><strong class="text-gray-400">Start date :</strong> <span id="start-date"> Start Date</span></p>
                        <p class="text-black"><strong class="text-gray-400">End date :</strong> <span id="end-date"> End Date</span></p>
                    </div>
                </div>
            </div>
        </div>
</div>