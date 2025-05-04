<div class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">{{$slot}}</h5>
    <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
        <button onclick="setEditModalData('{{ $dataid }}','{{$nombre}}')" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="w-full sm:w-auto bg-blue-950 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-blue-700 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
            <div class="text-left rtl:text-right">
                <div class="-mt-1 font-sans text-sm font-semibold">Editar</div>
            </div>
        </button>
        <button  data-id="{{ $dataid }}" onclick="setDeleteRoute('{{ $dataid }}','{{route('destroyEspecialidad', ['id' => '__id__']) }}')"  data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="w-full sm:w-auto bg-red-950 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-800">
            <div class="text-left rtl:text-right ">
                <div class="-mt-1 font-sans text-sm font-semibold">Eliminar</div>
            </div>
        </button>
    </div>
</div>