<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cita en curso de ') }} {{ $paciente->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
                {{ __('Porfavor registra los campos acorde a la cita') }}
            </h3>

            <form method="POST" action="{{ route('finalizarCita', [$paciente->id, $cita->id]) }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-text-area id="observaciones" type="text" name="observaciones" label="Observaciones"
                        :value="old('observaciones')" required autocomplete="observaciones" placeholder="Observaciones">
                        Escriba las observaciones de la cita
                    </x-input-text-area>
                    <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <x-input-text-area id="receta" type="text" name="receta"
                        label="Receta (si no hay receta dejar en blanco)" :value="old('receta')" autocomplete="receta"
                        placeholder="Receta">
                        Escriba la receta de la cita
                    </x-input-text-area>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <h3 class="mb-4 mt-4 font-semibold text-gray-900 dark:text-white">Rellene el recuadro
                        correspondiente</h3>

                    <x-input-radio id="requiere" type="radio" required name="estado" value="true"
                        onclick="showTratamientoDiv()">
                        {{ __('REQUIERE TRATAMIENTO') }}
                    </x-input-radio>
                    <x-input-radio id="noRequiere" type="radio" name="estado" value="false"
                        onclick="hideTratamientoDiv()">
                        {{ __('NO REQUIERE TRATAMIENTO') }}
                    </x-input-radio>
                    <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                </div>

                <div class="mt-4" id="tratamientoDiv" hidden>
                    <x-input-text-area id="diagnostico" type="text" name="diagnostico" label="Diagnostico"
                        :value="old('diagnostico')" autocomplete="diagnostico" placeholder="Diagnostico">
                        Escriba el diagnostico del tratamiento
                    </x-input-text-area>
                    <x-input-error :messages="$errors->get('diagnostico')" class="mt-2" />

                    <div class="mt-4">
                        <x-input-text-area id="indicaciones" type="text" name="indicaciones" label="Indicaciones"
                            :value="old('indicaciones')" autocomplete="indicaciones" placeholder="Indicaciones">
                            Escriba las inidicaciones para el tratamiento
                        </x-input-text-area>
                        <x-input-error :messages="$errors->get('indicaciones')" class="mt-2" />
                    </div>


                    <div id="iniciodiaDiv" class="mt-4">
                        <x-input-label for="inicioFecha" :value="__('Elige la fecha inicial para tu cita:')" />
                        <input type="text" id="inicioFecha" name="inicioFecha" class="form-control"
                            placeholder="Selecciona una fecha">
                        <x-input-error :messages="$errors->get('inicioFecha')" class="mt-2" />
                    </div>

                    <div id="findiaDiv" class="mt-4">
                        <x-input-label for="finFecha" :value="__('Elige la fecha final para tu cita:')" />
                        <input type="text" id="finFecha" name="finFecha" class="form-control"
                            placeholder="Selecciona una fecha">
                        <x-input-error :messages="$errors->get('finFecha')" class="mt-2" />
                    </div>


                </div>



                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Finalizar Cita') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>



</x-app-layout>
