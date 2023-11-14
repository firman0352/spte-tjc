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
                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('jabatan.index')" :active="request()->routeIs('jabatan.index')">
                                            {{ __('Jabatan') }}
                                        </x-responsive-nav-link>
                                    </div>

                                    <div class="pt-2 pb-3 space-y-1">
                                        <x-responsive-nav-link :href="route('inspektur.index')" :active="request()->routeIs('inspektur.index')">
                                            {{ __('Inspektur') }}
                                        </x-responsive-nav-link>
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
<!-- <div class="-mr-2 flex items-center md:hidden">
            <button @click="open = ! open" @click.outside="open = false" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div> -->

<!-- Responsive Navigation Menu -->
<!-- <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden flex-1 justify-self-end">
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
<div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('jabatan.index')" :active="request()->routeIs('jabatan.index')">
                        {{ __('Jabatan') }}
                    </x-responsive-nav-link>
                </div>
@endif -->
<!-- Responsive Settings Options -->
<!-- <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link> -->

<!-- Authentication -->
<!-- <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div> -->
