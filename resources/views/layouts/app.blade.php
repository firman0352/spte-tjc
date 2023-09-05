<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased flex flex-row">
        <div class="min-h-screen bg-white-purple">
            @include('layouts.sidebar')
            <div class="min-h-screen bg-white-purple w-full">
            @include('layouts.navigation')
            <div class="pt-16 md:pl-48">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="lg:px-16 md:px-6 pt-8">
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
    </body>
</html>
