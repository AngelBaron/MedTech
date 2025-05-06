import { Calendar } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

const calendarEl = document.getElementById('calendar');

const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

if (calendarEl) {
    if (isDarkMode) {
        calendarEl.classList.add('dark'); // Puedes personalizar con Tailwind o CSS
    } else {
        calendarEl.classList.remove('dark');
    }

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        locale: 'es',
        events: '/citas-json',
        dateClick: function (info) {

            console.log('Día clickeado:', info.dateStr);
            
        }
    });

    calendar.render();
}