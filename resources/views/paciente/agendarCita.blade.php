<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agendar Cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif


            <form method="POST" action="{{ route('agendarCita') }}">
                @csrf
                <div class="mt-4">
                    <x-input-label for="especialidad" :value="__('Especialidad')" />
                    <select id="especialidad" name="especialidad" class="block mt-1 w-full"
                        oninput="seleccionEspecialidad()">
                        <option value="" disabled selected>Porfavor elige una especialidad</option>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('especialidad')" class="mt-2" />
                </div>

                <div class="mt-4" hidden id="medicosDiv">
                    <x-input-label for="medicos" :value="__('Medico')" />
                    <select id="medicos" name="medicos" class="block mt-1 w-full" oninput="seleccionMedico()">

                    </select>
                    <x-input-error :messages="$errors->get('medicos')" class="mt-2" />
                </div>

                <div hidden id="diaDiv" class="mt-4">
                    <x-input-label for="fecha" :value="__('Elige tu fecha para tu cita:')" />
                    <input type="text" id="fecha" name="fecha" class="form-control" placeholder="Selecciona una fecha"
                        oninput="seleccionFecha()">
                </div>

                <div hidden id="horaDiv" class="mt-4">
                    <x-input-label for="hora" :value="__('Elige tu hora para tu cita:')" />
                    <select id="hora" name="hora" class="form-select block mt-1 w-full" oninput="seleccionHora()">
                        <option value="">Selecciona una hora</option>
                    </select>
                </div>


                <div id="motivoDiv" hidden class="mt-4">
                    <x-input-label for="motivo" :value="__('Motivo')" />
                    <x-text-input id="motivo" class="block mt-1 w-full" type="text" name="motivo"
                        :value="old('motivo')" required autofocus autocomplete="motivo" oninput="seleccionMotivo()"/>
                    <x-input-error :messages="$errors->get('motivo')" class="mt-2" />
                </div>

                <div id="submitDiv" hidden class="mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Agendar Cita') }}
                    </x-primary-button>
                </div>



            </form>
        </div>
    </div>



</x-app-layout>
