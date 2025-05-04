<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agendar Cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif


            
            <div class="mt-4">
                <x-input-label for="especialidad" :value="__('Especialidad')" />
                <select id="especialidad" name="especialidad" class="block mt-1 w-full" oninput="seleccionEspecialidad()">
                    <option value="" disabled selected>Porfavor elige una especialidad</option>
                    @foreach ($especialidades as $especialidad)
                        <option  value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('especialidad')" class="mt-2" />
            </div>

            <div class="mt-4" hidden id="medicosDiv">
                <x-input-label for="medicos" :value="__('Medico')" />
                <select id="medicos" name="medicos" class="block mt-1 w-full" oninput="seleccionMedico()" >
                    
                </select>
                <x-input-error :messages="$errors->get('medicos')" class="mt-2" />
            </div>
            


            
        </div>
    </div>



</x-app-layout>
