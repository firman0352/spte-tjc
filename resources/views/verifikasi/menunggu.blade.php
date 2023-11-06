
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Verification Submission List') }}
        </h2>
    </x-slot>
 
    <div>
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
 
                    <div class="min-w-full align-middle">
                        <table id="listTable" class=" nowrap hover compact">
                            <thead>
                            <tr>
                            <th class="bg-transparant px-6 py-3 text-left">
                                    <span class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Company Name</span>
                                </th>
                                <th class="bg-transparant px-6 py-3 text-left">
                                    <span class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Name</span>
                                </th>
                                <th class="bg-transparant px-6 py-3 text-left">
                                    <span class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Email</span>
                                </th>
                                <th class="bg-transparant px-6 py-3 text-left">
                                    <span class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Status</span>
                                </th>
                                <th class="w-56 bg-transparant px-6 py-3 text-left dt-head-center">
                                    <span class="text-xs font-bold uppercase leading-4 tracking-wider text-black">Action</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach($dokumen as $item)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 text-sm font-semibold leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            {{ $item->nama_pt }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            {{ $item->user->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            {{ $item->user->email }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap w-1/5">
                                            <x-status-badge :status_id="$item->status_id" :status="$item->status->status" />
                                        </td>
                                        <td class="px-6 py-4 text-sm  leading-5 text-gray-900 whitespace-no-wrap w-1/5 dt-body-center">
                                            <a href="{{ route('admin.verifikasi.create', ['dokumen' => $item]) }}"
                                               class="px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800 gap-1 hover:bg-cyan-200 hover:text-cyan-900">
                                               <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="12px">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path>
                                               </svg> 
                                               Verify
                                            </a>
                                            <form action="{{ route('admin.verifikasi.tolak', ['dokumen' => $item]) }}" method="POST" data-dokumen-id="{{ $item->id }}" style="display: inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="decline-button px-2 py-0 lg:py-1 inline-flex items-center text-sm lg:text-md leading-5 font-semibold rounded-full bg-pink-100 text-pink-800 gap-1 hover:bg-pink-200 hover:text-pink-900" >
                                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="12px">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                </svg>     
                                                Decline
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
    <script>
    // Select all buttons with the decline-button class
    const declineButtons = document.querySelectorAll('.decline-button');

    declineButtons.forEach(button => {
        button.addEventListener('click', function() {
            const dokumenId = this.parentElement.getAttribute('data-dokumen-id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, decline it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.querySelector(`form[data-dokumen-id="${dokumenId}"]`);
                    form.submit();
                }
            });
        });
    });
</script>
</x-app-layout>