<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Review Pengajuan') }}
        </h2>
    </x-slot>

    <div class="max-w-full px-4 w-1/2">
        <div class="overflow-hidden bg-white shadow-sm rounded-lg">
            <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                <form action="{{ route('admin.pengajuan.approve', $pengajuan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <x-input-label for="harga" value="Price per Tons" />
                    <x-text-input id="harga" name="harga" type="text" class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />

                    <x-input-label for="dokumen" value="Document" />
                    <input id="dokumen" name="dokumen" type="file" class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('dokumen')" class="mt-2" />

                    <div class="mt-4">
                        <x-primary-button>
                            Approve
                        </x-primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('admin.pengajuan.reject', $pengajuan->id) }}">
                    @csrf
                    @method('PATCH')
                    <x-danger-button class="justify-center mt-1 w-full">
                        Reject
                    </x-danger-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
