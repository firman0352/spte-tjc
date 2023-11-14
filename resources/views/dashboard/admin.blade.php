<div class="flex justify-between">
    <div class="bg-white overflow-hidden shadow-sm rounded-lg w-1/6 flex flex-col items-center py-3">
        <p class="text-md text-black font-bold">Total User </p>
        <div class="flex items-center gap-1 text-indigo-500 mt-2">
            <p class="text-5xl">{{ $totalUsers }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg w-1/6 flex flex-col items-center py-3">
        <p class="text-md text-black font-bold">Verified User </p>
        <div class="flex items-center gap-1 text-indigo-500 mt-2">
            <p class="text-5xl">{{ $totalDokumenCustomers }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg w-1/6 flex flex-col items-center py-3">
        <p class="text-md text-black font-bold">Total Inspector </p>
        <div class="flex items-center gap-1 text-indigo-500 mt-2">
            <p class="text-5xl">{{ $totalInspector }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg w-1/6 flex flex-col items-center py-3">
        <p class="text-md text-black font-bold">Total Transaction </p>
        <div class="flex items-center gap-1 text-indigo-500 mt-2">
            <p class="text-5xl">{{ $totalDokumenCustomers }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg w-1/6 flex flex-col items-center py-3">
        <p class="text-md text-black font-bold">Successful Transaction </p>
        <div class="flex items-center gap-1 text-indigo-500 mt-2">
            <p class="text-5xl">{{ $totalDokumenCustomers }}</p>
        </div>
    </div>
</div>

<div class="flex w-full mt-10 gap-10">
    <div class="bg-white overflow-hidden shadow-sm rounded-lg w-2/5 max-h-80">
        <div class="p-6 text-gray-900 flex flex-col items-center">
            <img src="{{ asset('svg/welcoming.svg') }}" alt="welcoming image" class="w-[180px]">
            <p class="text-black font-bold text-lg">{{ __('Welcome back') }}, {{ Auth::user()->name }}
            </p>
            <p>{{ __("You're logged in!") }}</p>
        </div>
    </div>
    <div class="flex flex-col gap-5 w-3/5">
        @if ($needVerification)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg py-4 px-10">
                <a href="{{ route('admin.verifikasi.menunggu') }}" class="text-black flex justify-between items-center">
                    <div class="py-2 gap-4 items-center flex">
                        <span class="bg-yellow-500  rounded-full px-3 py-1 text-white">{{ $needVerification }}</span>
                        <span>
                            @if ($needVerification == 1)
                                Customer wait to be prepared for the verification process.
                            @else
                                Customers wait to be prepared for the verification process.
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

        @if ($needSpecificApproval)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg py-4 px-10">
                <a href="{{ route('admin.pengajuan.index') }}" class="text-black flex justify-between items-center">
                    <div class="py-2 gap-4 items-center flex">
                        <span
                            class="bg-yellow-500  rounded-full px-3 py-1 text-white">{{ $needSpecificApproval }}</span>
                        <span>
                            @if ($needSpecificApproval == 1)
                                Customer wait for the process of checking product specifications.
                            @else
                                Customers wait for the process of checking product specifications.
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

        @if ($offeringApproval)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg py-4 px-10">
                <a href="{{ route('admin.pengajuan.index') }}" class="text-black flex justify-between items-center">
                    <div class="py-2 gap-4 items-center flex">
                        <span class="bg-yellow-500  rounded-full px-3 py-1 text-white">{{ $offeringApproval }}</span>
                        <span>
                            @if ($offeringApproval == 1)
                                Customer rejects the price offer and submits a new offer.
                            @else
                                Customers rejects the price offer and submits a new offer.
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
    </div>
</div>
