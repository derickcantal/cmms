import './bootstrap';
import "flowbite";
import Alpine from 'alpinejs';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

let calendarEl = document.getElementById('calendar');
let calendar = new Calendar(calendarEl, {
  dateClick: function() {
    alert('a day has been clicked!');
    // alert("The view's title is " + view.description);
  },
plugins: [  dayGridPlugin,
            timeGridPlugin,
            listPlugin,
            interactionPlugin ],

initialView: 'dayGridMonth',
selectable: true,
events: '/events',
editable: false,



headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,listWeek'
}


});
// calendar.batchRendering(function() {
//   calendar.changeView('dayGridMonth');
//   calendar.addEvent({ title: 'new event', 
//                       start: '2025-05-01' });
// });
calendar.render();

window.Alpine = Alpine;

Alpine.start();