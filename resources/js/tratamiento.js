let contador = 1;

window.nuevoMedicamento = function () {
    const contenedor = document.getElementById('contenedor-selects');
    const selects = contenedor.querySelectorAll('.select-medicamento');
    const ultimoSelect = selects[selects.length - 1];

    if (!ultimoSelect.value) {
        alert('Selecciona una medicina antes de añadir otra.');
        return;
    }

    const grupo = document.createElement('div');
    grupo.className = 'mt-4 grupo-medicamento';

    // Label y select
    const label = document.createElement('label');
    label.className = 'block font-medium text-sm text-gray-700';
    label.textContent = 'Medicamento';

    const select = document.createElement('select');
    select.name = 'medicamentos[]';
    select.id = `medicamento-${contador}`;
    select.className = 'block mt-1 w-full select-medicamento';
    select.required = true;
    select.onchange = function () {
        mostrarCamposAdicionales(select);
    };

    const opcionInicial = document.createElement('option');
    opcionInicial.value = '';
    opcionInicial.disabled = true;
    opcionInicial.selected = true;
    opcionInicial.textContent = 'Por favor elige una medicina';
    select.appendChild(opcionInicial);

    listaMedicinas.forEach(med => {
        const opt = document.createElement('option');
        opt.value = med.id;
        opt.textContent = med.nombre;
        select.appendChild(opt);
    });

    grupo.appendChild(label);
    grupo.appendChild(select);

    const camposDiv = document.createElement('div');
    camposDiv.className = 'campos-adicionales mt-4';
    grupo.appendChild(camposDiv);

    contenedor.appendChild(grupo);
    contador++;
};


window.mostrarCamposAdicionales = function(selectElement) {
    const grupo = selectElement.closest('.grupo-medicamento');
    const contenedorCampos = grupo.querySelector('.campos-adicionales');
    contenedorCampos.innerHTML = '';

    const campos = [
        { name: 'dosis[]', label: 'Dosis (número)', type: 'number' },
        { name: 'horas[]', label: 'Horas (número)', type: 'number' },
        { name: 'frecuencia[]', label: 'Frecuencia', type: 'text' },
        { name: 'duracion_dias[]', label: 'Duración (en días)', type: 'number' }
    ];

    campos.forEach(campo => {
        const div = document.createElement('div');
        div.className = 'mt-2';

        // Label
        const label = document.createElement('label');
        label.className = 'block font-medium text-sm text-gray-700 dark:text-gray-300';
        label.textContent = campo.label;

        // Input
        const input = document.createElement('input');
        input.type = campo.type;
        input.name = campo.name;
        input.required = true;
        input.min = 1;
        input.className = 'block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm';

        div.appendChild(label);
        div.appendChild(input);
        contenedorCampos.appendChild(div);
    });
}