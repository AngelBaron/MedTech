import { Calendar } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

async function cargarConteo() {
    const response = await fetch('/conteo-citas');
    const data = await response.json();

    return data.map(cita => ({
        title: '', 
        start: cita.fecha,
        allDay: true,
        extendedProps: {
            pendientes: cita.pendiente,
            confirmadas: cita.confirmada,
            canceladas: cita.cancelada,
        }
    }));
}


const calendarEl = document.getElementById('calendar');

const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

if (calendarEl) {
    if (isDarkMode) {
        calendarEl.classList.add('dark'); // Puedes personalizar con Tailwind o CSS
    } else {
        calendarEl.classList.remove('dark');
    }

    const eventos = await cargarConteo();

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        locale: 'es',
        events: eventos,
        eventContent: function (arg) {
            const { pendientes, confirmadas, canceladas } = arg.event.extendedProps;

            console.log('Pendientes:', pendientes);
            console.log('Confirmadas:', confirmadas);

            return {
                html: `
                    <div class="flex flex-col items-start space-y-1 w-full">
                        <button type="button"
                        style="background-color: #1d3f7e  !important;"
                        data-fecha="${arg.event.startStr}"
                        class="btn-pendientes bg-red-400 text-xs text-white px-2 py-1 rounded w-full text-left">
                            ${pendientes} Pendientes
                        </button>
                        <button type="button"
                        style="background-color: #328e37 !important;"
                        data-fecha="${arg.event.startStr}"
                        class="btn-confirmadas bg-green-500 text-xs text-white px-2 py-1 rounded w-full text-left">
                            ${confirmadas} Confirmadas
                        </button>

                        <button type="button"
                        style="background-color:  #8e3232 !important;"
                        data-fecha="${arg.event.startStr}"
                        class="btn-canceladas bg-green-500 text-xs text-white px-2 py-1 rounded w-full text-left">
                            ${canceladas} Canceladas
                        </button>
                    </div>
                `
            };
        },
        eventDidMount: function (info) {
            info.el.classList.remove('fc-event', 'fc-daygrid-event', 'fc-h-event', 'fc-event-draggable');
            info.el.classList.add('!p-0', '!bg-transparent', '!border-none');
        },
        dateClick: function (info) {
            console.log('Fecha:', info.dateStr);
        }
    });

    calendar.render();


    document.addEventListener('click', async function (e) {
        const fecha = e.target.dataset.fecha;
    
        if (e.target.classList.contains('btn-pendientes')) {
            const data = await fetch(`/citas-detalle/pendiente/${fecha}`).then(r => r.json());
            mostrarModalPendientes(data, fecha);
        }
    
        if (e.target.classList.contains('btn-confirmadas')) {
            const data = await fetch(`/citas-detalle/confirmada/${fecha}`).then(r => r.json());
            mostrarModalConfirmadas(data, fecha);
        }
    
        if (e.target.classList.contains('btn-canceladas')) {
            const data = await fetch(`/citas-detalle/cancelada/${fecha}`).then(r => r.json());
            mostrarModalCanceladas(data, fecha);
        }
    });



    
    
    function mostrarModalPendientes(data, fecha) {
        const cont = document.getElementById('modal-contenido');
        document.getElementById('modal-titulo').innerText = `Pendientes - ${fecha}`;
        cont.innerHTML = data
            .sort((a, b) => compararHoras(a.hora, b.hora))
            .map(cita => `
                <div class="border p-2 rounded shadow-sm bg-yellow-100 text-sm">
                    <p class= "text-gray-900 dark:text-white"><strong>Paciente:</strong> ${cita.paciente.user.name}</p>
                    <p class= "text-gray-900 dark:text-white"><strong>Hora:</strong> ${cita.hora}</p>
                    <p class= "text-gray-900 dark:text-white"><strong>Motivo:</strong> ${cita.motivo_cita}</p>
                    <div class="flex gap-2 mt-2">
                        <button class="bg-green-600 text-white px-2 py-1 rounded text-xs " style="background-color: #328e37 !important;">Confirmar</button>
                        <button class="bg-red-600 text-white px-2 py-1 rounded text-xs">Cancelar</button>
                    </div>
                </div>
            `).join('');
        document.getElementById('modal-citas').classList.remove('hidden');
    }
    
    function mostrarModalConfirmadas(data, fecha) {
        const cont = document.getElementById('modal-contenido');
        document.getElementById('modal-titulo').innerText = `Confirmadas - ${fecha}`;
        cont.innerHTML = data
            .sort((a, b) => compararHoras(a.hora, b.hora))
            .map(cita => `
                <div class="border p-2 rounded shadow-sm bg-green-100 text-sm">
                    <p class= "text-gray-900 dark:text-white"><strong>Paciente:</strong> ${cita.paciente.user.name}</p>
                    <p class= "text-gray-900 dark:text-white"><strong>Hora:</strong> ${cita.hora}</p>
                    <p class= "text-gray-900 dark:text-white"><strong>Motivo:</strong> ${cita.motivo_cita}</p>
                    <div class="flex gap-2 mt-2">
                        <button class="bg-red-600 text-white px-2 py-1 rounded text-xs">Cancelar</button>
                    </div>
                </div>
            `).join('');
        document.getElementById('modal-citas').classList.remove('hidden');
    }
    
    function mostrarModalCanceladas(data, fecha) {
        const cont = document.getElementById('modal-contenido');
        document.getElementById('modal-titulo').innerText = `Canceladas - ${fecha}`;
        cont.innerHTML = data
            .sort((a, b) => compararHoras(a.hora, b.hora))
            .map(cita => `
                <div class="border p-2 rounded shadow-sm bg-red-100 text-sm">
                    <p class= "text-gray-900 dark:text-white"><strong>Paciente:</strong> ${cita.paciente.user.name}</p>
                    <p class= "text-gray-900 dark:text-white"><strong>Hora:</strong> ${cita.hora}</p>
                    <p class= "text-gray-900 dark:text-white"><strong>Motivo:</strong> ${cita.motivo_cita}</p>
                </div>
            `).join('');
        document.getElementById('modal-citas').classList.remove('hidden');
    }
    
    function compararHoras(a, b) {
        // Si a es 00:00 y b no, se considera más tarde
        if (a.startsWith('00') && !b.startsWith('00')) return 1;
        if (!a.startsWith('00') && b.startsWith('00')) return -1;
        return a.localeCompare(b);
    }


}

