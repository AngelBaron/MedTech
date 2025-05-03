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
                    <x-text-input id="especialidad" class="block mt-1 w-full" type="text" name="especialidad"
                        :value="old('especialidad')" required />
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



                <h3 class="mb-4 mt-4 font-semibold text-gray-900 dark:text-white">Disponibilidad</h3>
                <ul
                    class="max-w-96 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="Matutino" type="checkbox" value="1" onclick="selectOnly2(event)"
                                name="turno[]"
                                class="opciones-check w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="Matutino"
                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Matutino
                                (08:00-16:00)</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="Vespertino" type="checkbox" value="2" onclick="selectOnly2(event)"
                                name="turno[]"
                                class="opciones-check w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="Vespertino"
                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Vespertino
                                (16:00-24:00)</label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="Nocturno" type="checkbox" value="4" onclick="selectOnly2(event)"
                                name="turno[]"
                                class="opciones-check w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="Nocturno"
                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nocturno
                                (24:00-8:00)</label>
                        </div>
                    </li>
                    <x-input-error :messages="$errors->get('turno')" class="mt-2" />
                </ul>






                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Registrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>



</x-app-layout>
