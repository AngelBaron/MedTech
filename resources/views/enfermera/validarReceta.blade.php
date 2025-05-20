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

        
        </div>
    </div>


</x-app-layout>
