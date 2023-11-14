<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change Password') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-full space-y-6 md:px-0">
            <div class="px-4 flex lg:flex-row max-w-full flex-col ">

                <div class="p-4 sm:p-8 bg-white shadow rounded-lg lg:basis-1/2">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
