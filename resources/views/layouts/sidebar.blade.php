@extends('layouts.app')
<nav x-data="{ open: false }" class="hidden md:block bg-white border-b border-gray-100 fixed">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto pt-16 px-4 sm:px-6 lg:px-8 min-h-screen w-48">
        <div class="flex justify-between h-16">
            <div class="flex flex-col w-full">
                <!-- Navigation Links -->
                <div class="hidden  sm:-my-px sm:mt-8 sm:flex flex-col ">
                    <div class="flex flex-col space-y-10">
                    <div class="flex flex-col space-y-4">
                    <label class="text-grey-500 font-bold">Dashboard</label>
                    <x-nav-link :href="route(auth()->user()->roleName().'.dashboard')" :active="request()->routeIs(auth()->user()->roleName().'.dashboard')">
                        <div class="flex felx-row items-center gap-2">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="25px">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"></path>
                            </svg>
                            <label class=" cursor-pointer">{{ __('Overview') }}</label>
                        </div>
                    </x-nav-link>
                    </div>
                    @if (auth()->user()->roleName() == 'admin')
                    <div class="flex flex-col space-y-4">
                    <label class="text-grey-500 font-bold">Roles</label>
                            <x-nav-link :href="route('jabatan.index')" :active="request()->routeIs('jabatan.index')">
                                <div class="flex felx-row items-center gap-2">
                                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="25px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"></path>
                                    </svg>
                                    <label class=" cursor-pointer">{{ __('Jabatan') }}</label>
                                </div>
                            </x-nav-link>
                        <x-nav-link :href="route('inspektur.index')" :active="request()->routeIs('inspektur.index')">
                                <div class="flex felx-row items-center gap-2">
                                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="25px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                                    </svg>
                                    <label class=" cursor-pointer">{{ __('Inspektur') }}</label>
                                </div>
                        </x-nav-link>
                    </div>
                    <div class="flex flex-col space-y-4">
                    <label class="text-grey-500 font-bold">Verification</label>
                        <x-nav-link :href="route('verifikasi.index')" :active="request()->routeIs('verifikasi.index')">
                            <div class="flex felx-row items-center gap-2">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="25px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"></path>
                                </svg>
                                <label class=" cursor-pointer">{{ __('In Process') }}</label>
                            </div>
                        </x-nav-link>
                        <x-nav-link :href="route('admin.verifikasi.menunggu')" :active="request()->routeIs('admin.verifikasi.menunggu')">
                            <div class="flex felx-row items-center gap-2">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="25px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                </svg>
                                <label class=" cursor-pointer">{{ __('Waiting List') }}</label>
                            </div>
                        </x-nav-link>   
                    </div>        
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
    </div>
</nav>
