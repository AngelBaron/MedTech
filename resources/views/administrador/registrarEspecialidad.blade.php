<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Especialidad') }}
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
                {{ __('Porfavor registra los campos solicitados') }}
            </h3>

            <form method="POST" action="{{ route('registrarEspecialidad') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="nombre" :value="__('Nombre')" />
                    <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                        :value="old('nombre')" required autofocus autocomplete="nombre" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Registrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>



    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
            {{ __('Lista de Especialidades') }}
        </h3>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 justify-self-center pt-6 ml-4 mr-4">


            @foreach ($especialidades as $especialidad)
                <x-card-info dataid="{{ $especialidad->id }}" nombre="{{ $especialidad->nombre }}">
                    {{ $especialidad->nombre }}
                </x-card-info>
            @endforeach



        </div>
    </div>


    <x-modal-borrar>

    </x-modal-borrar>

    <x-modal-editar>

    </x-modal-editar>



</x-app-layout>
