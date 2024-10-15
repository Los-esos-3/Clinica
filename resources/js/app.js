import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded event fired');
    
    var calendarEl = document.getElementById('calendar');
    if (!calendarEl) {
        console.error('Elemento del calendario no encontrado');
        return;
    }
    console.log('Elemento del calendario encontrado');

    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        locale: esLocale,
        editable: false,
        events: '/get-citas',
        eventContent: function(arg) {
            console.log('Renderizando evento:', arg.event.title);
            var eventElement = document.createElement('div');
            eventElement.classList.add('fc-event-main-frame');

            var titleElement = document.createElement('div');
            titleElement.classList.add('fc-event-title-container');

            var titleText = document.createElement('div');
            titleText.classList.add('fc-event-title', 'fc-sticky');

            var titleParts = arg.event.title.split(' - Dr. ');
            var pacienteName = titleParts[0];
            var doctorName = titleParts[1] || '';

            var pacienteElement = document.createElement('div');
            pacienteElement.innerHTML = '<strong>Paciente:</strong> ' + pacienteName;
            pacienteElement.style.fontWeight = 'normal';

            var doctorElement = document.createElement('div');
            doctorElement.innerHTML = '<strong>Doctor:</strong> Dr. ' + doctorName;
            doctorElement.style.fontSize = '0.9em';

            // Añadir el elemento de hora
            var horaElement = document.createElement('div');
            horaElement.innerHTML = '<strong>Hora:</strong> ' + (arg.event.extendedProps.horaFormateada || '');
            horaElement.style.fontSize = '0.9em';

            titleText.appendChild(pacienteElement);
            titleText.appendChild(doctorElement);
            titleText.appendChild(horaElement);

            titleElement.appendChild(titleText);
            eventElement.appendChild(titleElement);

            return { domNodes: [eventElement] };
        },
        eventDidMount: function(info) {
            info.el.style.height = 'auto';
            info.el.style.minHeight = '2em'; // Aumentado para acomodar el contenido adicional
        }
    });

    console.log('Calendario configurado, intentando renderizar');
    calendar.render();
    console.log('Calendario renderizado');
});