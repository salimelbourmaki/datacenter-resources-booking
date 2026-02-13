/* resources/js/reservations/calendar.js */

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listMonth'
        },
        buttonText: {
            today: "Aujourd'hui",
            month: "Mois",
            week: "Semaine",
            list: "Liste"
        },
        events: window.calendarEvents || [],
        eventClick: function(info) {
            const modal = document.getElementById('eventModal');
            const res = info.event.extendedProps;
            
            document.getElementById('eventResource').textContent = res.resource;
            document.getElementById('eventUser').textContent = res.user;
            document.getElementById('eventStart').textContent = info.event.start.toLocaleString();
            document.getElementById('eventEnd').textContent = info.event.end ? info.event.end.toLocaleString() : '-';
            
            modal.style.display = 'flex';
        }
    });

    calendar.render();

    // Fermer la modale
    const closeModal = document.getElementById('closeModal');
    const modal = document.getElementById('eventModal');
    
    if (closeModal) {
        closeModal.onclick = () => { modal.style.display = 'none'; };
    }
    
    window.onclick = (event) => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
});
