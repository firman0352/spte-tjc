<x-app-layout>
    <x-slot name="title">
        {{ __('Profile') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-full space-y-6 md:px-0">
            <div class="px-4 flex lg:flex-row max-w-full flex-col ">

                <div class="p-4 sm:p-8 bg-white shadow rounded-lg lg:basis-1/2 lg:mr-3">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow rounded-lg lg:basis-1/2 lg:ml-3 mt-6 lg:mt-0">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('/profil.js') }}"></script>
</x-app-layout>
