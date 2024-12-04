document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: '/expedientes/citas', // Endpoint del método getCitas
        eventContent: function (info) {
            // Crear contenedor personalizado para el evento
            const container = document.createElement('div');

            // Añadir el contenido del evento con formato escalera
            container.innerHTML = `
                <div>
                    <strong>Paciente:</strong> ${info.event.extendedProps.paciente}<br>
                    <strong>Doctor:</strong> ${info.event.extendedProps.doctor}<br>
                    <strong>Hora:</strong> ${info.event.extendedProps.hora}
                </div>
            `;

            return { domNodes: [container] };
        },
        eventClick: function (info) {
            // Mostrar la información del evento con formato escalera en el alert
            alert(
                `Detalles de la cita:\n` +
                `Paciente: ${info.event.extendedProps.paciente}\n` +
                `Doctor: ${info.event.extendedProps.doctor}\n` +
                `Hora: ${info.event.extendedProps.hora}`
            );
        }
    });

    calendar.render();
});
