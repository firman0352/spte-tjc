<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }} | Tri Jaya Coco
        @else
            Tri Jaya Coco
        @endisset
    </title>

    <!-- Fonts -->

    <link rel="icon" href="{{ asset('/Logo-PT.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/Logo-PT.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/lightbox.min.css') }}">

    <style>
        .dataTables_wrapper .dataTables_length select {
            min-width: 4rem;
        }

        .dataTables_wrapper .dataTables_length {
            margin-right: 1rem;
        }

        @media screen and (max-width: 640px) {
            .dataTables_wrapper .dataTables_length {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }

        .dataTables_wrapper .dataTable tbody tr:hover {
            background-color: #F1F1FB;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 0.375rem;
        }

        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #6865EF;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.375rem;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #6865EF;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 0.375rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #6865EF !important;
            background: inherit;
            border: inherit;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            color: #6865EF !important;
            background: inherit;
            border: 0.5px solid #ffff;
            box-shadow: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #F1F1FB !important;
            background: #6865EF;
            border: 0.5px solid #F1F1FB;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #F1F1FB !important;
            background: #6865EF;
            border: 0.5px solid #F1F1FB;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:active {
            color: #F1F1FB !important;
            background: #6865EF;
            border: 0.5px solid #F1F1FB;
        }

        .dt-buttons .dt-button {
            border-radius: 0.375rem !important;
            border: 0.5px solid #F1F1FB !important;
            outline: 2px solid transparent;
            /* Set the initial outline to transparent */
            outline-offset: 2px;
            /* Offset the outline from the element */
            outline-color: #6865EF !important;
            /* Set the indigo color */
            transition-duration: 50ms;
            /* duration-150 */
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1) !important;
            /* transition-ease-in-out */
            width: 5rem;
        }

        .dt-buttons .dt-button span {
            display: flex;
            gap: 2px;
        }

        .dt-buttons .buttons-excel {
            background-color: #16a34a !important;
            color: #ffff !important;
        }

        .dt-buttons .buttons-pdf {
            background-color: #D13606 !important;
            color: #ffff !important;
        }

        .dt-buttons .buttons-print {
            background-color: #2563eb !important;
            color: #ffff !important;
        }

        .dt-buttons .dt-button:focus {
            border: 0.5px solid #6865EF !important;
            outline: 2px solid #6865EF;
            /* Set the indigo color on focus */
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/init-alpine.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

</head>

<body x-data="data()" class="font-sans antialiased flex flex-row">
    <div class="min-h-screen bg-white-purple">
        @include('layouts.sidebar')
        <div class="min-h-screen bg-white-purple w-full">
            @include('layouts.navigation')
            <div class="pt-16 duration-300 md:pl-60"
                :class="{ 'md:pl-20': isMinimizeSidebar, 'md:pl-60': !isMinimizeSidebar }">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="lg:px-16 md:px-6 ">
                        <div class="max-w-full py-6 px-4 ">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="lg:px-16 md:px-6 pb-20">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ URL::asset('/dist/js/lightbox.min.js') }}"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>
    <script>
        let table = new DataTable('#listTable');
        $(document).ready(function() {
            // Destroy the existing DataTable instance
            if ($.fn.DataTable.isDataTable('#listTable')) {
                $('#listTable').DataTable().destroy();
            }

            // Reinitialize the DataTable
            $('#listTable').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                        text: '<svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="15px"><path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5"></path></svg> Excel',
                        extend: 'excel',
                        exportOptions: {
                            columns: [1]
                        }
                    },
                    {
                        text: '<svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="15px"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg> PDF',
                        extend: 'pdf',
                        exportOptions: {
                            columns: [2]
                        }
                    },
                    {
                        text: '<svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="15px"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"></path></svg> Print',
                        extend: 'print',
                    }
                ]
            });
        });
    </script>
</body>

</html>
