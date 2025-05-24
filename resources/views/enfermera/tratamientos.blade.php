<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tratamientos') }}
        </h2>
    </x-slot>



    @foreach ($tratamientos as $tratamiento)
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
                            {{ __('Tratamiento de ') }} {{ $tratamiento->paciente->user->name }}
                        </h3>

                        <p><strong>Diagnostico del Tratamiento:</strong> {{ $tratamiento->diagnostico }}</p>
                        <p><strong>Indicaciones:</strong> {{ $tratamiento->indicaciones }}</p>
                        <p><strong>Fecha de Inicio:</strong> {{ $tratamiento->fecha_inicio }}</p>
                        <p><strong>Fecha de Fin:</strong> {{ $tratamiento->fecha_fin }}</p>
                        @if ($validados->where('tratamiento_id',$tratamiento->id))
                            <div class="mt-4">
                            <x-button>
                                <a href="{{ route('suministrarReceta', $tratamiento->id) }}">
                                    {{ __('Suministrar') }}
                                </a>
                            </x-button>
                        </div>
                        @else
                        <div class="mt-4">
                            <x-button>
                                <a href="{{ route('validarReceta', $tratamiento->id) }}">
                                    {{ __('Validar Receta') }}
                                </a>
                            </x-button>
                        </div>
                        @endif

                       
                    </div>
                </div>


            </div>
        </div>
    @endforeach


</x-app-layout>
