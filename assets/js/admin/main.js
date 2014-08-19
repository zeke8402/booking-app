$(document).ready(function() {
  var cDate = new Date();
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'Test',
      right: 'month,agendaWeek,agendaDay'
    },
    defaultDate: '2014-08-19',
    editable: true,
    events: [
          {
            title: 'Test Event',
            start: cDate
          }
      
    ]
  });
});