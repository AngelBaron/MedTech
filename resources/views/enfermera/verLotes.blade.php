<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Lote'). " " . $medicina->nombre }}
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
                {{ __('Para agregar un nuevo lote agrega los siguientes campos') }}
            </h3>

            <form method="POST" action="{{ route('registrarLote',$medicina->id) }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="numeroLote" :value="__('Numero de lote')" />
                    <x-text-input id="numeroLote" class="block mt-1 w-full" type="text" name="numeroLote"
                        :value="old('numeroLote')" required autofocus autocomplete="numeroLote" />
                    <x-input-error :messages="$errors->get('numeroLote')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="date" :value="__('Fecha de caducidad')" />
                    <input type="text" id="fechaLote" name="fecha" class="form-control" placeholder="Selecciona una fecha"
                        >
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                

                <div class="mt-4">
                    <x-input-label for="cantidad" :value="__('Cantidad del lote')" />
                    <x-text-input id="cantidad" class="block mt-1 w-full" type="number" name="cantidad"
                        :value="old('cantidad')" required />
                    <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                </div>


                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Registrar Lote') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


   

</x-app-layout>