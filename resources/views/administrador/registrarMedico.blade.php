<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Medico') }}
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

            <form method="POST" action="{{ route('registrarMedico') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="especialidad" :value="__('Especialidad')" />
                    <select id="especialidad" name="especialidad" class="block mt-1 w-full">
                        <option value="" disabled selected>Porfavor elige una especialidad</option>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('especialidad')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <x-input-label for="cedula" :value="__('Cedula Profesional')" />
                    <x-text-input id="cedula" class="block mt-1 w-full" type="text" name="cedula"
                        :value="old('cedula')" required />
                    <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
                </div>

                <h3 class="mb-4 mt-4 font-semibold text-gray-900 dark:text-white"">Dias a trabajar</h3>
                <div class="flex items-center me-4">
                    <x-check-box id="lunes" name="dias[]" value="Lunes" color="red"> Lunes </x-check-box>
                    <x-check-box id="martes" name="dias[]" value="Martes" color="blue">Martes </x-check-box>
                    <x-check-box id="miercoles" name="dias[]" value="Miercoles" color="green">Miércoles </x-check-box>
                    <x-check-box id="jueves" name="dias[]" value="Jueves" color="teal">Jueves </x-check-box>
                    <x-check-box id="viernes" name="dias[]" value="Viernes" color="purple">Viernes </x-check-box>
                    <x-check-box id="sabado" name="dias[]" value="Sabado" color="gray">Sábado </x-check-box>
                    <x-check-box id="domingo" name="dias[]" value="Domingo" color="indigo">Domingo </x-check-box>
                </div>



                

                <div class="mt-4">
                    <x-input-label for="turno" :value="__('Disponibilidad')" />
                    <select id="turno" name="turno" class="block mt-1 w-full">
                        <option value="" disabled selected>Porfavor elige un horario</option>
                        <option value="1">Matutino(08:00-16:00)</option>
                        <option value="2">Vespertino(16:00-24:00)</option>
                        <option value="3">Nocturno(24:00-8:00)</option>
                    </select>
                    <x-input-error :messages="$errors->get('turno')" class="mt-2" />
                </div>


                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Registrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>



</x-app-layout>
