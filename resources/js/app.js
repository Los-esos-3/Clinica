import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        editable: false,
        events: '/get-citas',
        eventContent: function(arg) {
            let eventWrapper = document.createElement('div');
            eventWrapper.classList.add('fc-event-main-frame');

            let titleEl = document.createElement('div');
            titleEl.classList.add('fc-event-title-container');
            titleEl.innerHTML = '<div class="fc-event-title fc-sticky">' + arg.event.title + '</div>';

            let doctorEl = document.createElement('div');
            doctorEl.classList.add('fc-event-doctor');
            doctorEl.innerHTML = 'Dr. ' + arg.event.extendedProps.doctor;

            eventWrapper.appendChild(titleEl);
            eventWrapper.appendChild(doctorEl);

            return { domNodes: [eventWrapper] };
        }
    });

    calendar.render();
});