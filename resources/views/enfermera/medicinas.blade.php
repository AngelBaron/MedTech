<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Medicinas') }}
        </h2>
    </x-slot>

    {{-- Aqui se pone el form para registrar medicinas --}}

    {{-- pa la racha jajaja --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">
                {{ __('Registro para medicina') }}
            </h3>

            <form method="POST" action="{{ route('registrarMedicina') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>



                <div class="mt-4">
                    <x-input-label for="descripcion" :value="__('Descripcion')" />
                    <x-text-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion"
                        :value="old('descripcion')" required />
                    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                </div>



                <div class="mt-4">
                    <x-input-label for="via" :value="__('Via de administracion')" />
                    <select id="via" name="via" class="block mt-1 w-full">
                        <option value="" disabled selected>Porfavor elige un método de administracion</option>
                        <option value="Oral">Oral</option>
                        <option value="Sublingual">Sublingual</option>
                        <option value="Rectal">Rectal</option>
                        <option value="Intravenosa">Intravenosa</option>
                        <option value="Intramuscular">Intramuscular</option>
                        <option value="Subcutánea">Subcutánea</option>
                        <option value="Tópica">Tópica</option>
                        <option value="Inhalatoria">Inhalatoria</option>
                        <option value="Transdérmica">Transdérmica</option>
                        <option value="Vaginal">Vaginal</option>
                        <option value="Intratecal">Intratecal</option>
                        <option value="Intraauricular">Intraauricular</option>
                        <option value="Intraocular">Intraocular</option>
                        <option value="Intraarterial">Intraarterial</option>
                        <option value="Epidural">Epidural</option>
                        <option value="Intranasal">Intranasal</option>
                        <option value="Intraperitoneal">Intraperitoneal</option>
                    </select>
                    <x-input-error :messages="$errors->get('via')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="concentracion" :value="__('Concentracion')" />
                    <x-text-input id="concentracion" class="block mt-1 w-full" type="text" name="concentracion"
                        :value="old('concentracion')" required />
                    <x-input-error :messages="$errors->get('concentracion')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="presentacion" :value="__('Presentacion')" />
                    <x-text-input id="presentacion" class="block mt-1 w-full" type="text" name="presentacion"
                        :value="old('presentacion')" required />
                    <x-input-error :messages="$errors->get('presentacion')" class="mt-2" />
                </div>


                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Registrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


    {{-- Aqui la lista de medicinas disponibles --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 justify-self-center pt-6 ml-4 mr-4">
        @foreach ($medicinas as $medicina)
            <x-card-info-med ruta="{{ route('ver-lote', $medicina->id) }}" titulo="Ver lotes">
                {{ $medicina->nombre }}
            </x-card-info-med>
        @endforeach
    </div>

</x-app-layout>
