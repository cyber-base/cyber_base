// document.addEventListener('DOMContentLoaded', () => {
//     var calendarEl = document.getElementById('calendar-holder');

//     var calendar = new FullCalendar.Calendar(calendarEl, {
//         defaultView: 'dayGridMonth',
//         locale : 'fr',
//         editable: true,
//         eventSources: [
//             {
//                 url: "/fc-load-events",
//                 method: "POST",
//                 extraParams: {
//                     filters: JSON.stringify({})
//                 },
//                 failure: () => {
//                     // alert("There was an error while fetching FullCalendar!");
//                 },
//             },
//         ],
//         header: {
//             left: 'prev,next today',
//             center: 'title',
//             right: 'dayGridMonth,timeGridWeek,timeGridDay',
            
//         },
        

//         plugins: [ 'interaction', 'dayGrid', 'timeGrid' ], // https://fullcalendar.io/docs/plugin-index
//         timeZone: 'Europe/Paris',
//     });
//     calendar.render();
// });


{/* <script>
window.onload = () => {

let  calendarElt = document.querySelector("#calendrier");

let calendar = new FullCalendar.Calendar(calendarElt, {
initialView: 'dayGridWeek',
locale : 'fr',
timeZone: 'Europe/Paris',
headerToolbar: {
    start: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay',
    
},

});
calendar.render();
} */}