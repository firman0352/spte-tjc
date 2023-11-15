<div class=" flex flex-col sm:flex-row justify-between gap-10">
    <div class=" flex sm:flex-col sm:justify-between gap-10 sm:w-1/4 ">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg flex flex-col items-center py-3 px-3 sm:px-0">
            <p class="text-md text-black font-bold">Total Transaction</p>
            <div class="flex items-center gap-1 text-indigo-500 mt-2">
                <p class="text-5xl">{{ $totalTransaction }}</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-lg flex flex-col items-center py-3 px-3 sm:px-0">
            <p class="text-md text-black font-bold">Successful Transaction</p>
            <div class="flex items-center gap-1 text-indigo-500 mt-2">
                <p class="text-5xl">{{ $totalSuccessOrders }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm rounded-lg sm:w-3/4 flex flex-col items-center py-3 ">
        @if (auth()->user()->dokumenCustomer)
            @if (auth()->user()->dokumenCustomer->status_id == 3)
                <div class="p-6 flex items-center gap-3 text-indigo-500 mt-2">
                    <img src="{{ asset('svg/complete.svg') }}" alt="complete image" class="w-[140px]">
                    <div class="flex flex-col gap-2 items-center">
                        <p class="text-2xl text-center font-bold text-green-500">Your documents have been verified</p>
                        <p class="text-md text-center">Your documents have been verified, make a transaction now.</p>
                        <a href="{{ route('pengajuan.index') }}"
                            class="bg-indigo-500 text-white px-2 py-1 rounded-lg hover:bg-indigo-600 focus:bg-indigo-600 active:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Check
                            the Products here</a>
                    </div>
                </div>
            @else
                <div class="p-6 flex items-center gap-3 text-indigo-500 mt-2">
                    <img src="{{ asset('svg/progress.svg') }}" alt="progress image" class="w-[120px] sm:w-[200px]">
                    <div class="flex flex-col gap-2 items-center">
                        <p class="text-2xl text-center font-bold">Be patient,</p>
                        <p class="text-2xl text-center font-bold">your documents are being checked!</p>
                        <p class="text-md text-center">Thank you for submitting your documents, all your company
                            documents are being checked, please be patient..</p>
                        @if (auth()->user()->dokumenCustomer->status_id == 2)
                            <progress class="progress progress-primary w-56 mt-5" value="20"
                                max="100"></progress>
                        @elseif (auth()->user()->dokumenCustomer->status_id == 6)
                            <progress class="progress progress-primary w-56 mt-5" value="50"
                                max="100"></progress>
                        @elseif (auth()->user()->dokumenCustomer->status_id == 7)
                            <progress class="progress progress-primary w-56 mt-5" value="80"
                                max="100"></progress>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="p-6 flex items-center gap-1 text-indigo-500 mt-2">
                <img src="{{ asset('svg/starting.svg') }}" alt="starting image" class="w-[200px]">
                <div class="flex flex-col gap-2 items-center">
                    <p class="text-2xl text-center font-bold">Verify your document</p>
                    <p class="text-md text-center">Let's verify your company documents now, so you can purchase our
                        products.</p>
                    <a href="{{ route('dokumen.index') }}"
                        class="bg-indigo-500 text-white px-2 py-1 rounded-lg hover:bg-indigo-600 focus:bg-indigo-600 active:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Let's
                        check here</a>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="flex flex-col sm:flex-row gap-10 mt-10 w-full">
    <div class="bg-white overflow-hidden shadow-sm rounded-lg sm:w-2/5 max-h-80">
        <div class="p-6 text-gray-900 flex flex-col items-center">
            <img src="{{ asset('svg/welcoming.svg') }}" alt="welcoming image" class="w-[180px]">
            <p class="text-black font-bold text-lg">{{ __('Welcome back') }}, {{ Auth::user()->name }}</p>
            <p>{{ __("You're logged in!") }}</p>
        </div>
    </div>
    <div class="flex flex-col gap-5 sm:w-3/5">
        @if (auth()->user()->dokumenCustomer)
            @if (auth()->user()->dokumenCustomer->status_id == 4)
                <div class="bg-white overflow-hidden shadow-sm rounded-lg py-4 px-10">
                    <a href="{{ route('dokumen.index') }}" class="text-black flex justify-between items-center">
                        <div class="py-2 gap-4 items-center flex">
                            <span class="bg-yellow-500  rounded-full px-1 py-1 text-white">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="20px">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0">
                                    </path>
                                </svg>
                            </span>
                            <span>
                                Your company's document submission was rejected, you need to fix it
                            </span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z" />
                        </svg>
                    </a>
                </div>
            @endif
            @if (auth()->user()->dokumenCustomer->status_id == 5)
                <div class="bg-white overflow-hidden shadow-sm rounded-lg py-4 px-10">
                    <a href="{{ route('dokumen.index') }}" class="text-black flex justify-between items-center">
                        <div class="py-2 gap-4 items-center flex">
                            <span class="bg-yellow-500  rounded-full px-1 py-1 text-white">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="20px">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0">
                                    </path>
                                </svg>
                            </span>
                            <span>
                                You've fixed your company documents, but you haven't sent them yet, send them now
                            </span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z" />
                        </svg>
                    </a>
                </div>
            @endif
        @endif
        @if ($needApproval)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg py-4 px-10">
                <a href="{{ route('pengajuan.index') }}" class="text-black flex justify-between items-center">
                    <div class="py-2 gap-4 items-center flex">
                        <span class="bg-yellow-500  rounded-full px-3 py-1 text-white">{{ $needApproval }}</span>
                        <span>
                            @if ($needApproval == 1)
                                Product you submitted have been quoted, let's check them out.
                            @else
                                Products you submitted have been quoted, let's check them out.
                            @endif
                        </span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z" />
                    </svg>
                </a>
            </div>
        @endif
        @if ($reSubmit)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg py-4 px-10">
                <a href="{{ route('pengajuan.index') }}" class="text-black flex justify-between items-center">
                    <div class="py-2 gap-4 items-center flex">
                        <span class="bg-yellow-500  rounded-full px-3 py-1 text-white">{{ $reSubmit }}</span>
                        <span>
                            @if ($reSubmit == 1)
                                Product that you negotiated have been given a new price offer.
                            @else
                                Products that you negotiated have been given a new price offer.
                            @endif
                        </span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z" />
                    </svg>
                </a>
            </div>
        @endif
        @if ($waitFOD)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg py-4 px-10">
                <a href="{{ route('pengajuan.index') }}" class="text-black flex justify-between items-center">
                    <div class="py-2 gap-4 items-center flex">
                        <span class="bg-yellow-500  rounded-full px-3 py-1 text-white">{{ $waitFOD }}</span>
                        <span>
                            Submission process is waiting for final offering documents.
                        </span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z" />
                    </svg>
                </a>
            </div>
        @endif
        @if ($waitProcess)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg py-4 px-10">
                <a href="{{ route('pengajuan.index') }}" class="text-black flex justify-between items-center">
                    <div class="py-2 gap-4 items-center flex">
                        <span class="bg-yellow-500  rounded-full px-3 py-1 text-white">{{ $waitProcess }}</span>
                        <span>
                            Approved bids are waiting to be processed
                        </span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z" />
                    </svg>
                </a>
            </div>
        @endif
    </div>
</div>
