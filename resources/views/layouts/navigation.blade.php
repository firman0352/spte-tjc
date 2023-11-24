<nav class="bg-white border-b border-gray-100 fixed w-full top-0 left-0 flex justify-between sm:block  z-40">
    <!-- Primary Navigation Menu -->
    <div class="flex-1 px-4 md:px-8 sm:ml-0 mx-auto flex flex-row-reverse justify-start shadow duration-300"
        :class="{ 'md:ml-20': isMinimizeSidebar, 'md:ml-48': !isMinimizeSidebar }">
        <div class="flex h-16 w-full ">
            <div class="justify-between w-full flex">
                <!-- Logo -->
                <div class="flex flex-row gap-2">

                </div>

                <!-- Settings Dropdown -->
                <div class="flex flex-row">
                    <div class="flex items-center hidden md:inline-flex ">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Hamburger -->
                    <div class="drawer drawer-end block md:hidden">
                        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                        <div class="drawer-content">
                            <div class="shrink-0 flex items-center h-16 justify-self-end ">
                                <label for="my-drawer">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                        <div class="drawer-side">
                            <label for="my-drawer" class="drawer-overlay"></label>
                            <div class="menu p-4 w-80 min-h-full bg-white-purple text-base-content">

                                <!-- Sidebar content here -->
                                <div class="pt-2 pb-3 space-y-1">
                                    <x-responsive-nav-link :href="route(
                                        auth()
                                            ->user()
                                            ->roleName() . '.dashboard',
                                    )" :active="request()->routeIs(
                                        auth()
                                            ->user()
                                            ->roleName() . '.dashboard',
                                    )">
                                        {{ __('Dashboard') }}
                                    </x-responsive-nav-link>
                                </div>

                                @if (auth()->user()->roleName() == 'admin')
                                    <hr class="h-px bg-gray-500 border-1">
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('admin.verifikasi.menunggu')" :active="request()->routeIs('admin.verifikasi.menunggu')">
                                            {{ __('Waiting List Verification') }}
                                        </x-responsive-nav-link>
                                    </div>
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('verifikasi.index')" :active="request()->routeIs('verifikasi.index')">
                                            {{ __('Process Verification') }}
                                        </x-responsive-nav-link>
                                    </div>
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('verifikasi.history')" :active="request()->routeIs('verifikasi.history')">
                                            {{ __('History Verification') }}
                                        </x-responsive-nav-link>
                                    </div>
                                    <hr class="h-px bg-gray-500 border-1">
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('admin.pengajuan.index')" :active="request()->routeIs('admin.pengajuan.index')">
                                            {{ __('Product Specification') }}
                                        </x-responsive-nav-link>
                                    </div>
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.index')">
                                            {{ __('Product Order') }}
                                        </x-responsive-nav-link>
                                    </div>
                                    <hr class="h-px bg-gray-500 border-1">
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('jabatan.index')" :active="request()->routeIs('jabatan.index')">
                                            {{ __('Inspector Position') }}
                                        </x-responsive-nav-link>
                                    </div>
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('inspektur.index')" :active="request()->routeIs('inspektur.index')">
                                            {{ __('Inspector') }}
                                        </x-responsive-nav-link>
                                    </div>
                                @endif
                                @if (auth()->user()->roleName() == 'customer')
                                    <hr class="h-px bg-gray-500 border-1">
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('dokumen.index')" :active="request()->routeIs('dokumen.index')">
                                            {{ __('Document') }}
                                        </x-responsive-nav-link>
                                    </div>
                                    @if (auth()->user()->dokumenCustomer)
                                        @if (auth()->user()->dokumenCustomer->status_id == 3)
                                            <hr class="h-px bg-gray-500 border-1">
                                            <div class="pt-2 pb-3 space-y-1">
                                                <x-responsive-nav-link :href="route('pengajuan.index')" :active="request()->routeIs('pengajuan.index')">
                                                    {{ __('Product Specification') }}
                                                </x-responsive-nav-link>
                                            </div>
                                            <div class="pt-2 pb-3 space-y-1">
                                                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                                                    {{ __('Product Order') }}
                                                </x-responsive-nav-link>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                @if (auth()->user()->roleName() == 'inspektur')
                                    <hr class="h-px bg-gray-500 border-1">
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('inspektur.verifikasi.index')" :active="request()->routeIs('inspektur.verifikasi.index')">
                                            {{ __('Document Verification') }}
                                        </x-responsive-nav-link>
                                    </div>
                                @endif

                                <!-- Responsive Settings Options -->
                                <div class="pt-4 pb-1 border-t border-gray-200">
                                    <div class="px-4">
                                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>

                                    <div class="mt-3 space-y-1">
                                        <x-responsive-nav-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-responsive-nav-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-responsive-nav-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-responsive-nav-link>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</nav>
