<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Inspector Roles') }}
            </h2>
            <a href="{{ route('jabatan.create') }}" class="gap-1 inline-flex items-center rounded-lg border bg-purple-300 border-white-purple px-4 py-2 text-xs font-semibold tracking-widest text-white shadow-sm transition duration-150 ease-in-out hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                <svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg> Add new
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
 
    <div >
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <div class="min-w-full align-middle">
                        <table id="listTable" class=" nowrap hover compact">
                            <thead>
                            <tr>
                                <th class="bg-transparant px-6 py-3 text-left">
                                    <span class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Role</span>
                                </th>
                                <th class="w-56 bg-transparant px-6 py-3 text-left dt-head-center">
                                    <span class="text-xs font-bold uppercase leading-4 tracking-wider text-black ">Action</span>
                                </th>
                            </tr>
                            </thead>
 
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach($jabatan as $jabatan)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-3/4">
                                            {{ $jabatan->jabatan }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/4 dt-body-center">
                                            <a href="{{ route('jabatan.edit', $jabatan) }}"
                                            class="inline-flex text-gray-500 items-center px-4 py-2 hover:text-black disabled:opacity-25">
                                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="25px">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('jabatan.destroy', $jabatan) }}" method="POST" data-id="{{$jabatan->id}}" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-button inline-flex text-red-500 items-center px-4 py-2 hover:text-red-700 disabled:opacity-25">
                                                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="25px">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('/delete-confirm.js') }}"></script>
</x-app-layout>