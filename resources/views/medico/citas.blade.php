<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tus citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="calendar"></div>
        </div>
    </div>

    <div id="modal-citas" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg w-full max-w-md overflow-y-auto max-h-[90vh]">
            <h2 id="modal-titulo" class="text-lg font-semibold mb-4 text-gray-900 dark:text-white"></h2>
            <div id="modal-contenido" class="space-y-4"></div>
            <button onclick="cerrarModal()" class="mt-4 bg-gray-700 text-white px-4 py-2 rounded">Cerrar</button>
        </div>
    </div>
</x-app-layout>
