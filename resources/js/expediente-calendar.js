document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('expediente-calendar');
    if (!calendarEl) {
        console.error('Elemento del calendario no encontrado');
        return;
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        height: 'auto',
        aspectRatio: 1.35,
        contentHeight: 'auto',
        events: '/get-citas',
        locale: 'es',
        firstDay: 1,
        dayHeaderFormat: { weekday: 'short' },
        views: {
            dayGridMonth: {
                dayHeaderFormat: { weekday: 'short' }
            }
        },
        eventContent: function(arg) {
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
            info.el.style.minHeight = '2em'; 
        }
    });

    calendar.render();

    // Añadir estilos personalizados después de renderizar el calendario
    var style = document.createElement('style');
    style.textContent = `
        .fc-theme-standard .fc-toolbar,
        .fc-theme-standard .fc-view-harness {
            background-color: white;
        }
        .fc .fc-button-primary {
            background-color: #f0f0f0;
            border-color: #d0d0d0;
            color: black;
        }
        .fc .fc-button-primary:hover {
            background-color: #e0e0e0;
            border-color: #c0c0c0;
        }
        .fc .fc-button-primary:not(:disabled).fc-button-active,
        .fc .fc-button-primary:not(:disabled):active {
            background-color: #d0d0d0;
            border-color: #b0b0b0;
            color: black;
        }
        .fc-daygrid-day-number,
        .fc-col-header-cell-cushion,
        .fc-daygrid-day-top {
            color: black !important;
        }
        .fc-day-today {
            background-color: #f8f8f8 !important;
        }
        .fc-event {
            background-color: #f0f0f0;
            border-color: #d0d0d0;
            color: black;
        }
        .fc-event-title,
        .fc-event-time {
            color: black;
        }
    `;
    document.head.appendChild(style);
});
