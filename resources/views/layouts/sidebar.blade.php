<nav x-data="{ open: false }" class="hidden md:block bg-white border-b border-gray-100 fixed">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto pt-16 px-4 sm:px-6 lg:px-8 min-h-screen w-48">
        <div class="flex justify-between h-16">
            <div class="flex flex-col w-full">
                

                <!-- Navigation Links -->
                <div class="hidden space-y-8 sm:-my-px sm:mt-8 sm:flex flex-col mx-auto">
                    <x-nav-link :href="route(auth()->user()->roleName().'.dashboard')" :active="request()->routeIs(auth()->user()->roleName().'.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if (auth()->user()->roleName() == 'admin')
                        <x-nav-link :href="route('jabatan.index')" :active="request()->routeIs('jabatan.index')">
                            {{ __('Jabatan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('inspektur.index')" :active="request()->routeIs('inspektur.index')">
                            {{ __('Inspektur') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.verifikasi.menunggu')" :active="request()->routeIs('admin.verifikasi.menunggu')">
                            {{ __('Menunggu Verifikasi') }}
                        </x-nav-link>
                        <x-nav-link :href="route('verifikasi.index')" :active="request()->routeIs('verifikasi.index')">
                            {{ __('Proses Verifikasi') }}
                        </x-nav-link>
                    @endif
                    @if (auth()->user()->roleName() == 'customer')
                        <x-nav-link :href="route('dokumen.index')" :active="request()->routeIs('dokumen.index')">
                            {{ __('Dokumen') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</nav>
