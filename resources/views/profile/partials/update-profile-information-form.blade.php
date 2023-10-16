<section x-data="edit"> 
    <header> 
        <h2 class="text-lg font-medium text-gray-900">
        {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
        {{ __("Update your account's profile information and email address.") }}
        </p>
    </header> 
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="form" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 " :class="isEdit ? '' : 'hidden' "> @csrf @method('patch') 
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <p id="output">Please enter a valid number below with country code</p>
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autofocus autocomplete="phone" />
            <input id="hidden" type="hidden" name="phone-full">
            <span>e.g +6282245824411, +3546113542</span>
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div>
        <p class="text-sm mt-2 text-gray-800">
            {{ __('Your email address is unverified.') }}

            <button form="send-verification"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Click here to re-send the verification email.') }}
            </button>
        </p>

    @if (session('status') === 'verification-link-sent')
        <p class="mt-2 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to your email address.') }}
        </p>
    @endif
    </div>
    @endif
    </div>

    <div class="flex flex-col items-center gap-4">
        <x-primary-button @click="editClose">{{ __('Save') }}</x-primary-button>
    </div>
    </form>
    <div class="mt-6 space-y-6" :class="isEdit ? 'hidden' : '' ">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-label-value  class="mt-1 block w-full" :value="old('name', $user->name)"  />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-label-value  class="mt-1 block w-full" :value="old('phone', $user->phone)"  />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-label-value  class="mt-1 block w-full text-black text-base" :value="old('email', $user->email)"  />
        <div>
        <div class="flex flex-col items-center gap-4 mt-4">
            <x-primary-button @click="editAble">{{ __('Edit Profil') }}</x-primary-button>
        </div>
    </div>
    @if (session('status') === 'profile-updated')
        <div class="toast toast-top toast-center">
            <div class="alert alert-success" x-data="{ show: true }" x-show="show" x-transition
                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600"><span>Profile has been
                    succesfully updated</span></div>
        </div>
        @endif

        <a href="{{ route('profile.edit.password') }}"
            class="mt-4 min-w-full items-center justify-center inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150'">
            {{ __('Change Password') }}
        </a>
        </div>
    </section>