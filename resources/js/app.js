import './bootstrap';

import Alpine from 'alpinejs';
import 'flowbite';

import flatpickr from "flatpickr";
import { Spanish } from "flatpickr/dist/l10n/es.js";
import "flatpickr/dist/flatpickr.min.css";
import "flatpickr/dist/themes/dark.css";



import './calendar'
import './cita'


window.Alpine = Alpine;

Alpine.start();
window.selectOnly2 = selectOnly2;
//FUNCIONES PARA EL ADMINISTRADOR
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


window.setEditModalData = function (id, name) {
    document.getElementById('id').value = id;
    document.getElementById('na').value = name;
};

window.setDeleteRoute = function (id, url) {
    const form = document.getElementById('delete-form');
    const urlTemplate = url;
    form.action = urlTemplate.replace('__id__', id);
};




//FUNCIONES PARA EL PACIENTE
window.seleccionEspecialidad = function () {
    let especialidad = document.getElementById('especialidad').value;
    document.getElementById('diaDiv').style.display = 'none';
    document.getElementById('fecha').value = '';

    if (especialidad != 0) {
        fetch('/medicos-por-especialidad/' + especialidad)
            .then(response => response.json())
            .then(data => {
                let medicosSelect = document.getElementById('medicos');
                medicosSelect.innerHTML = '<option disabled selected>Por favor elige un médico</option>';
                data.forEach(medico => {
                    if (medico.medico) {
                        medicosSelect.innerHTML += `<option value="${medico.medico.id}">${medico.medico.user.name}</option>`;
                    }

                });
                document.getElementById('medicosDiv').style.display = 'block';
            });
    }
};

window.seleccionMedico = function () {
    let medico = document.getElementById('medicos').value;

    if (medico != 0) {
        fetch('/dias-por-medico/' + medico)
            .then(response => response.json())
            .then(data => {
                // Mapear días en texto a índices numéricos (0-6)
                const diasTextoANumero = {
                    'Domingo': 0,
                    'Lunes': 1,
                    'Martes': 2,
                    'Miercoles': 3,
                    'Jueves': 4,
                    'Viernes': 5,
                    'Sabado': 6
                };

                // Convertimos a índices los días disponibles
                const disponibles = data.map(item => diasTextoANumero[item.dia.nombre]);

                // Obtener los días deshabilitados (no disponibles)
                const todosLosDias = [0, 1, 2, 3, 4, 5, 6];
                const deshabilitados = todosLosDias.filter(dia => !disponibles.includes(dia));

                // Inicializamos o actualizamos el calendario
                flatpickr("#fecha", {
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    maxDate: new Date().fp_incr(30),
                    locale: Spanish,
                    disable: [
                        function (date) {
                            return deshabilitados.includes(date.getDay());
                        }
                    ]
                });


                document.getElementById('diaDiv').style.display = 'block';
            });
    }
}

window.seleccionFecha = function () {
    const fecha = document.getElementById('fecha').value;
    const medico = document.getElementById('medicos').value;

    if (medico != 0) {
        fetch('/horas-por-medico/' + medico)
            .then(response => response.json())
            .then(horarioData => {
                const inicio = horarioData.horario_inicio; // "08:00:00"
                const fin = horarioData.horario_fin;       // "16:00:00"

                fetch('/citas-por-medico/' + medico + '/' + fecha)
                    .then(response => response.json())
                    .then(citasData => {
                        const horasOcupadas = citasData.map(c => c.hora.slice(0, 5)); // "HH:mm"
                        const horasDisponibles = generarHorasDisponibles(inicio, fin, horasOcupadas);

                        llenarSelect(horasDisponibles);
                    });
            });
    }
};

function generarHorasDisponibles(inicio, fin, ocupadas) {
    const disponibles = [];

    // Solo dejamos HH:mm
    inicio = inicio.slice(0, 5);
    fin = fin.slice(0, 5);

    let [h, m] = inicio.split(":").map(Number);
    let [fh, fm] = fin.split(":").map(Number);

    let startMinutes = h * 60 + m;
    let endMinutes = fh * 60 + fm;

    // Si el horario cruza la medianoche
    if (endMinutes <= startMinutes) {
        endMinutes += 24 * 60;
    }

    for (let mins = startMinutes; mins <= endMinutes; mins += 30) {
        let actualH = Math.floor(mins % (24 * 60) / 60);
        let actualM = mins % 60;
        const horaStr = `${actualH.toString().padStart(2, "0")}:${actualM.toString().padStart(2, "0")}`;

        if (!ocupadas.includes(horaStr)) {
            disponibles.push(horaStr);
        }
    }

    return disponibles;
}


function llenarSelect(horas) {
    const select = document.getElementById('hora');
    select.innerHTML = '<option value="">Selecciona una hora</option>';

    horas.forEach(hora => {
        const option = document.createElement('option');
        option.value = hora;
        option.textContent = hora;
        select.appendChild(option);
    });

    document.getElementById('horaDiv').style.display = 'block';
}

window.seleccionHora = function () {
    document.getElementById('motivoDiv').style.display = 'block';

}

window.seleccionMotivo = function () {
    document.getElementById('submitDiv').style.display = 'block';

}


const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

flatpickr("#fecha", {
    dateFormat: "Y-m-d",
    minDate: "today",
    maxDate: new Date().fp_incr(30), // 30 días a partir de hoy
    locale: Spanish, // Usa el objeto de localización en español
    disable: [
        function (date) {
            // 0 = domingo, 6 = sábado
            return (date.getDay() === 0 || date.getDay() === 6);
        }
    ],
    theme: prefersDark ? "dark" : "light"
});







window.cerrarModal = function () {
    document.getElementById('modal-citas').classList.add('hidden');
}


