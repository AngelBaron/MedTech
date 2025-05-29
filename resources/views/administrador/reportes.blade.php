<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generar reportes generales') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-xl dark:text-gray-200 text-gray-800 leading-tight">REPORTE GENERAL DE CITAS</h1>
                <x-button ><a href="{{route('exportar')}}">

                    Exportar
                    </a>
                </x-button>


        

        </div>
    </div>

</x-app-layout>