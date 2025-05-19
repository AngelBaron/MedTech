<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tratamientos') }}
        </h2>
    </x-slot>

    @foreach ($tratamientos as $tratamiento)

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
                            {{ __('Tratamiento de ') }} {{ $tratamiento->paciente->user->name }}
                        </h3>

                        <p><strong>Diagnostico del Tratamiento:</strong> {{ $tratamiento->diagnostico }}</p>
                        <p><strong>Indicaciones:</strong> {{ $tratamiento->indicaciones }}</p>
                        <p><strong>Fecha de Inicio:</strong> {{ $tratamiento->fecha_inicio }}</p>
                        <p><strong>Fecha de Fin:</strong> {{ $tratamiento->fecha_fin }}</p>
                    </div>
                </div>
            </div>
        </div>
        
    @endforeach


</x-app-layout>