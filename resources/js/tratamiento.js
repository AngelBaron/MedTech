let contador = 1;

window.nuevoMedicamento = function () {
    const contenedor = document.getElementById('contenedor-selects');
    const selects = contenedor.querySelectorAll('.select-medicamento');
    const ultimoSelect = selects[selects.length - 1];

    if (!ultimoSelect.value) {
        alert('Por favor selecciona una medicina antes de añadir otra.');
        return;
    }

    // Crear select dinámicamente
    const nuevoDiv = document.createElement('div');
    nuevoDiv.classList.add('mt-4');

    const label = document.createElement('label');
    label.setAttribute('for', `medicamento-${contador}`);
    label.className = 'block font-medium text-sm text-gray-700';
    label.textContent = 'Medicamento';

    const select = document.createElement('select');
    select.name = 'medicamentos[]';
    select.id = `medicamento-${contador}`;
    select.className = 'block mt-1 w-full select-medicamento';

    const opcionInicial = document.createElement('option');
    opcionInicial.value = '';
    opcionInicial.disabled = true;
    opcionInicial.selected = true;
    opcionInicial.textContent = 'Por favor elige una medicina';
    select.appendChild(opcionInicial);

    listaMedicinas.forEach(medicina => {
        const option = document.createElement('option');
        option.value = medicina.id;
        option.textContent = medicina.nombre;
        select.appendChild(option);
    });

    nuevoDiv.appendChild(label);
    nuevoDiv.appendChild(select);
    contenedor.appendChild(nuevoDiv);
    contador++;
};