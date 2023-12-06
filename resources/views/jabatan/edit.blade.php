<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Position') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Position') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <form action="{{ route('jabatan.update', $jabatan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="jabatan" value="Position" />
                            <x-text-input id="jabatan" name="jabatan" value="{{ old('jabatan', $jabatan->jabatan) }}"
                                type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
