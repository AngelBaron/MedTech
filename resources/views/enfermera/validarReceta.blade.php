<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">

            {{ __('Tratamiento de') }} {{ $tratamiento->paciente->user->name }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200 mt-4">
                Diagnostico
            </h3>
            <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                {{ $tratamiento->diagnostico }}
            </p>


            <h3 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200 mt-4">
                Indicaciones
            </h3>
            <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                {{ $tratamiento->indicaciones }}
            </p>


            <h3 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200 mt-4">
                Receta
            </h3>
            <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                {{ $archivo->receta->recetatxt }}
            </p>


            <h3 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200 mt-4">
                Observaciones
            </h3>
            <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                {{ $archivo->observaciones }}
            </p>

            {{-- FORM PARA LAS MEDICINAS BRO XD YA ME CANSE AYUDA SI LEEN ESTO Y SOY FAMOSO PORFAVOR DIGANME HUMILDAD ES LO PRIMERO --}}

            {{-- se hizo medicinas ahora toca un poco de codigo de form para hacer una lista de medicinas que sumninistrar al paciente cuando se haya validado una lista de botones de cada medicina con su "ultima suministracion " tal fecha para mañana --}}
            {{--Pa la racha--}}
            <form action="{{ route('validarRecetaPost', $tratamiento->id) }}" method="POST">
                @csrf
                <div class="mt-4">
                    <x-input-label for="medicamento" :value="__('Medicamento')" />
                    <select id="especialidad" name="especialidad" class="block mt-1 w-full">
                        <option value="" disabled selected>Porfavor elige una medicina</option>
                        @foreach ($medicinas as $medicina)
                            <option value="{{ $medicina->id }}">{{ $medicina->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('especialidad')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-button type="submit">
                        {{ __('Validar Receta') }}
                    </x-button>
                </div>

        </div>
    </div>


</x-app-layout>
