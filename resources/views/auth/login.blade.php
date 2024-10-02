<x-guest-layout>
    <div class="flex justify-between items-center">
        <div class="w-1/2 p-6">
            <x-authentication-card>
                <x-slot name="logo">
                  
                </x-slot>

                <x-validation-errors class="mb-4" />

                @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('register') }}" class="ms-4 px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('REGISTER') }}
                        </a>

                        <x-button class="ms-4">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
            </x-authentication-card>
        </div>

        <div class="w-1/2 p-6">
            <div class="pb-5">
                <x-authentication-card-logo />
            </div>
            
            <h2 class="text-xl font-semibold mb-4">Clinica PrinstonPlace</h2>
            <p class="text-gray-600">Preocupados por tu salud</p>
        </div>
    </div>
</x-guest-layout>
