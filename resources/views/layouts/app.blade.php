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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('/init-alpine.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
        


    </head>
    <body x-data="data()" class="font-sans antialiased flex flex-row" >
        <div class="min-h-screen bg-white-purple">
            @include('layouts.sidebar')
            <div class="min-h-screen bg-white-purple w-full">
                @include('layouts.navigation')
            <div class="pt-16 duration-300 md:pl-60" :class="{ 'md:pl-20': isMinimizeSidebar, 'md:pl-60': ! isMinimizeSidebar}">
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
            <script>
                const input = document.querySelector("#phone");
                // window.intlTelInput(input, {
                //     utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
                // });
                const output = document.querySelector("#output");
                const form = document.querySelector("#form");

                // initialise plugin
                const iti = window.intlTelInput(input, {
                    // separateDialCode: true,
                    preferredCountries:["id"],
                    hiddenInput: "full_phone",
                utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
                });
                // $("form").submit(function() {
                //     var full_number = phone.getNumber(intlTelInputUtils.numberFormat.E164);
                // $("input[name='phone'").val(full_number);
                //     alert(full_number)
                
                // });

                const handleChange = () => {
                let text;
                if (input.value) {
                    text = iti.isValidNumber()
                    ? "Valid number! Full international format: " + iti.getNumber()
                    : "Invalid number - please try again";
                } else {
                    text = "Please enter a valid number below with country code";
                }
                form.onsubmit = () => {
                    if (!iti.isValidNumber()) {
                        return false;
                        }
                    };
                const textNode = document.createTextNode(text);
                output.innerHTML = "";
                output.appendChild(textNode);
                };

                document.addEventListener('alpine:init', () => {
                    Alpine.data('edit', () => ({
                        isEdit: false,
            
                        editAble() {
                            this.isEdit = true
                        },

                        editClose() {
                            if (!iti.isValidNumber()) {
                                this.isEdit = true
                            }
                            else {
                                this.isEdit = false
                            }
                        }
                    }))
                })

                // listen to "keyup", but also "change" to update when the user selects a country
                input.addEventListener('change', handleChange);
                input.addEventListener('keyup', handleChange);
            </script>
    </body>
</html>
