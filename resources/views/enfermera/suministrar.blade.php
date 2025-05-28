<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tratamientos') }}
        </h2>
    </x-slot>



    <div class="py-4">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('failure'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('failure') }}
                </div>
            @endif

            <h2 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Diagnostico</h2>
            <h3 class="text-xs text-gray-900 dark:text-gray-200 leading-tight">{{ $archivo->tratamiento->diagnostico }}
            </h3>

            <h2 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Indicaciones</h2>
            <h3 class="text-xs text-gray-900 dark:text-gray-200 leading-tight">{{ $archivo->tratamiento->indicaciones }}
            </h3>


            <h2 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Diagnostico</h2>
            <h3 class="text-xs text-gray-900 dark:text-gray-200 leading-tight">{{ $archivo->tratamiento->diagnostico }}
            </h3>


            <h2 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Receta</h2>
            <h3 class="text-xs text-gray-900 dark:text-gray-200 leading-tight">{{ $archivo->receta->recetatxt }}</h3>



            @foreach ($archivo->tratamiento->tratamiento_medicamentos as $med)
                <div
                    class="p-4 text-center bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700 mt-4">
                    <h3 class="text-base text-gray-800 dark:text-gray-200 leading-tight">Medicamento</h3>
                    <p class="text-base text-gray-800 dark:text-gray-200 leading-tight">Nombre:
                        {{ $med->medicamento->nombre }}
                    </p>
                    <p class="text-base text-gray-800 dark:text-gray-200 leading-tight">Dosis: {{ $med->dosis }}</p>
                    <p class="text-base text-gray-800 dark:text-gray-200 leading-tight">Frecuencia:
                        {{ $med->frecuencia }}
                    </p>
                    <p class="text-base text-gray-800 dark:text-gray-200 leading-tight">Horas: {{ $med->horas }}</p>
                    <p class="text-base text-gray-800 dark:text-gray-200 leading-tight">Dias: {{ $med->duracion_dias }}
                        dias</p>

                    <p class="text-base text-gray-800 dark:text-gray-200 leading-tight"> Ultima vez</p>
                    @if ($med->dia_ultima)
                        <p class="text-base text-gray-800 dark:text-gray-200 leading-tight"> Dia:{{ $med->dia_ultima }}
                        </p>
                    @else
                        <p class="text-base text-gray-800 dark:text-gray-200 leading-tight"> Dia: NO HAY DIA</p>
                    @endif
                    @if ($med->hora_ultima)
                        <p class="text-base text-gray-800 dark:text-gray-200 leading-tight">
                            Hora:{{ $med->hora_ultima }}</p>
                    @else
                        <p class="text-base text-gray-800 dark:text-gray-200 leading-tight"> Hora: NO HAY HORA</p>
                    @endif

                    <form action="{{ route('suministrarMedicamento', $archivo->tratamiento->id) }}" method="post">
                        @csrf

                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Suministrar') }}
                            </x-primary-button>
                        </div>
                    </form>


                </div>
            @endforeach
        </div>

    </div>


</x-app-layout>
