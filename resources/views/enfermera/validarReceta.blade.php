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

            {{-- se deja pendiente hasta hacer medicamentos craks --}}

            <form action="{{ route('validarRecetaPost', $tratamiento->id) }}" method="POST">
                @csrf
                <div class="mt-4">
                    <label for="medicinas"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Medicinas</label>
                    <textarea id="medicinas" name="medicinas" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200"
                        required></textarea>
                </div>

                <div class="mt-4">
                    <x-button type="submit">
                        {{ __('Validar Receta') }}
                    </x-button>
                </div>

        </div>
    </div>


</x-app-layout>
