<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Upload ' . $title . ' Pictures') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route($routeName, $orders->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <x-input-label for="foto" class="block font-medium text-sm text-gray-700">{{ __('Upload ' . $title . ' Pictures') }}</x-input-label>
                        <input type="file" name="foto[]" id="foto" multiple accept="image/jpeg, image/png" class="mt-1 p-2 border rounded-md" aria-labelledby="foto_produksi-label">

                        @error('foto')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md">{{ __('Upload ' . $title . ' Pictures') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
