<nav x-data="{ open: false }" class="hidden sm:block bg-white border-b border-gray-100 fixed">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto pt-16 px-4 sm:px-6 lg:px-8 min-h-screen">
        <div class="flex justify-between h-16">
            <div class="flex flex-col">
                

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
