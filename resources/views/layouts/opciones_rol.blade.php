@if (Auth::user()->role == 'Administrador')
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('registrarMedico')" :active="request()->routeIs('registrarMedico')">
            {{ __('Registrar Medico') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('registrarEnfermera')" :active="request()->routeIs('registrarEnfermera')">
            {{ __('Registrar Enfermera') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('registrarEspecialidad')" :active="request()->routeIs('registrarEspecialidad')">
            {{ __('Registrar Especialidad') }}
        </x-nav-link>
    </div>
@endif

@if (Auth::user()->role == 'Paciente')
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('agendarCita')" :active="request()->routeIs('agendarCita')">
            {{ __('Agendar Cita') }}
        </x-nav-link>
    </div>

    
@endif

@if (Auth::user()->role == 'Medico')
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('citas')" :active="request()->routeIs('citas')">
            {{ __('Citas') }}
        </x-nav-link>
    </div>
@endif