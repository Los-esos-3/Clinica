<div class="flex">
    <!-- Main Content / Calendario -->
    <div id="main-content" class="flex-1 bg-white transition-all duration-300">
        
          <!-- Primary Navigation Menu -->

<div class="bg-gray-400 max-w-full">
    <div class="flex justify-between h-16">
        <div class="flex">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <button  id="menu-toggle"><i class="fa-solid fa-bars fa-xl"></i></button>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                   <label class="text-xl">Calendario</label>
                </x-nav-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link href="{{ route('Pacientes') }}" :active="request()->routeIs('Pacientes')">
                   <label class="text-xl">Pacientes</label>
                </x-nav-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                   <label class="text-xl">Expedientes</label>
                </x-nav-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                   <label class="text-xl">Ingresos</label>
                </x-nav-link>
            </div>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <!-- Teams Dropdown -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('Create New Team') }}
                                    </x-dropdown-link>
                                @endcan

                                <!-- Team Switcher -->
                                @if (Auth::user()->allTeams()->count() > 1)
                                    <div class="border-t border-gray-200"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" />
                                    @endforeach
                                @endif
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif

            <!-- Settings Dropdown -->
            <div class="ms-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="flex items-center px-4">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 me-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
            @endif

            <div>
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
        </div>

        <div class="mt-3 space-y-1">
            <!-- Account Management -->
            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-responsive-nav-link>
            @endif

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-responsive-nav-link href="{{ route('logout') }}"
                               @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>

            <!-- Team Management -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-responsive-nav-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                    <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                        {{ __('Create New Team') }}
                    </x-responsive-nav-link>
                @endcan

                <!-- Team Switcher -->
                @if (Auth::user()->allTeams()->count() > 1)
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-switchable-team :team="$team" component="responsive-nav-link" />
                    @endforeach
                @endif
            @endif
        </div>
    </div>
</div>

       
        
    </div>
</div>
 <!-- Vista Crud de pacientes-->

 

 <div class="flex items-center justify-between bg-gray-300 p-8 mb-4 border">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Pacientes') }}
    </h2>
    <a href="{{route('Pacientes.create')}}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
        <button>
        Agregar Paciente
    </button>
</a>
</div>


 <div class="py-12">
    <div class="mx-auto max-w-80% sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-md sm:rounded-lg">
            <div class="bg-white border-b border-gray-200 dark:bg-gray-300 dark:border-gray-600">
                <div class="overflow-x-auto"> <!-- Permite el desplazamiento horizontal -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-400">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Nombre del Paciente</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Número de Teléfono</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Fecha de Nacimiento</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Edad</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Dirección</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Género</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Estado Civil</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Fecha de Registro</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Tipo de Sangre</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Ocupación</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-800">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-300 dark:divide-gray-600">
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->telefono }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->fecha_nacimiento }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->edad }}</td>
                                    <td class="px-6 py-4 break-words whitespace-normal">{{ $paciente->direccion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->genero }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->estado_civil }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->fecha_registro }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->tipo_sangre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->ocupacion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('pacientes.edit', $paciente->id) }}" class="px-4 py-2 text-sm font-bold text-white bg-green-500 border border-green-700 rounded hover:bg-green-700">Editar</a>
                                        <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-red-500 border border-red-700 rounded hover:bg-red-700">Borrar</button>
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>