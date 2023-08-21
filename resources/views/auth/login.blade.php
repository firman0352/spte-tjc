<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!--  Show Password -->
        <div class="flex mt-4 items-center justify-between">
            <label for="show_password" class="inline-flex items-center">
                <input id="show_password" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="show_password" onclick="if (password.type == 'text') password.type = 'password';
                            else password.type = 'text';">
                <span class="ml-2 text-sm text-gray-600">{{ __('Show Password') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-purple-200 hover:text-purple-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex mt-8 justify-center">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="flex mt-8 justify-center">
                <a class="underline text-sm text-purple-200 hover:text-purple-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    {{ __('Create an Account') }}
                </a>
        </div>
    </form>
</x-guest-layout>
