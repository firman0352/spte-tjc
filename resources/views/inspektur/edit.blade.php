<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Jabatan Inspektur') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-full px-4">
            <div class="overflow-hidden bg-white shadow-sm rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <form action="{{ route('inspektur.update', $inspektur) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input readonly id="name" name="name" value="{{ $inspektur['user']['name'] }}" type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input readonly id="email" name="email" value="{{ $inspektur['user']['email'] }}" type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="jabatan" value="Jabatan" />
                            <select id="jabatan" name="jabatan" class="block mt-1 w-full">
                                <option value="{{$inspektur['jabatan_id']}}" disabled selected hidden >{{$inspektur['jabatan']['jabatan']}}</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                                @endforeach
                            </select>
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