<x-app-layout>
    <div class="min-h-screen flex">
        <aside>
            <x-sidebar :user="Auth::user()" />
        </aside>

        <div class="flex-grow bg-gray-100 transition-all duration-300 ml-0 md:ml-64" id="content">

            <div class="flex items-center justify-between bg-gray-300 p-3  border">



                <div class="flex items-center gap-16">
                    <button id="toggle-sidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <h2 class="text-xl pt-1.5 font-semibold leading-tight text-gray-800">
                        {{ __('Perfil') }}
                    </h2>
                </div>
            </div>

                <div class="bg-white">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')

                            <x-section-border />
                        @endif

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.update-password-form')
                            </div>

                            <x-section-border />
                        @endif

                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.two-factor-authentication-form')
                            </div>

                            <x-section-border />
                        @endif

                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <x-section-border />

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.delete-user-form')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
