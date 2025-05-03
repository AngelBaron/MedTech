import './bootstrap';

import Alpine from 'alpinejs';
import 'flowbite';

window.Alpine = Alpine;

Alpine.start();
window.selectOnly2 = selectOnly2;

//funcion que evita seleccionar 3 opciones en el checkbox con el id="checkbox"
function selectOnly2(event) {
    const checkboxes = document.querySelectorAll('.opciones-check');
    let checkedCount = 0;

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            checkedCount++;
        }
    });

    if (checkedCount > 2) {
        alert("Solo puedes seleccionar 2 opciones");
        // Desmarca el último checkbox marcado
        event.target.checked = false;
    }
}
