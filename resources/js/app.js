import './bootstrap';

import Alpine from 'alpinejs';
import 'flowbite';

import flatpickr from "flatpickr";
import { Spanish } from "flatpickr/dist/l10n/es.js";
import "flatpickr/dist/flatpickr.min.css";
import "flatpickr/dist/themes/dark.css";
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


window.setEditModalData = function (id, name) {
    document.getElementById('id').value = id;
    document.getElementById('na').value = name;
};

window.setDeleteRoute = function (id, url) {
    const form = document.getElementById('delete-form');
    const urlTemplate = url;
    form.action = urlTemplate.replace('__id__', id);
};

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



}

const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

if (prefersDark) {
    document.getElementById("fecha").classList.add("flatpickr-dark");
}

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

document.getElementById("hora").setAttribute("readonly", "readonly");

let fueSeleccionManual = true;

const inputHora = document.getElementById("hora");

flatpickr("#hora", {


    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    theme: prefersDark ? "dark" : "light",
    minTime: "16:00",
    maxTime: "22:30",
    minuteIncrement: 30,
    allowInput: false,  // Deshabilitar entrada manual
    onOpen: function () {
        fueSeleccionManual = false; // viene del calendario
    },
    onClose: function (selectedDates, dateStr, instance) {
        fueSeleccionManual = true; // ya se cerró, puede venir input manual
    }
});



inputHora.addEventListener("change", () => {
    const valor = inputHora.value;
    const [horaStr, minutosStr] = valor.split(":");

    let hora = parseInt(horaStr, 10);
    let minutos = parseInt(minutosStr, 10);

    if (isNaN(hora) || isNaN(minutos)) return;

    
    minutos = minutos < 15 ? 0 : (minutos < 45 ? 30 : 0);
    if (minutos === 0 && parseInt(minutosStr) >= 45) {
        hora = (hora + 1) % 24; 
    }

    
    const horaFormateada = hora.toString().padStart(2, "0");
    const minutosFormateados = minutos.toString().padStart(2, "0");

    inputHora.value = `${horaFormateada}:${minutosFormateados}`;
});