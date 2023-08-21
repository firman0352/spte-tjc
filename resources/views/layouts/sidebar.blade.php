<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8 min-h-screen">
        <div class="flex justify-between h-16">
            <div class="flex flex-col">
                <!-- Logo -->
                <div class="shrink-0 flex items-center h-16">
                    <a href="{{ route(auth()->user()->roleName().'.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-y-8 sm:-my-px sm:mt-8 sm:flex flex-col">
                    <x-nav-link :href="route(auth()->user()->roleName().'.dashboard')" :active="request()->routeIs(auth()->user()->roleName().'.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if (auth()->user()->roleName() == 'admin')
                        <x-nav-link :href="route('jabatan.index')" :active="request()->routeIs('jabatan.index')">
                            {{ __('Jabatan') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</nav>
