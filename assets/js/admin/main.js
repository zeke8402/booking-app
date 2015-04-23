$(document).ready(function() {
  var cDate = new Date();
  console.log(link);
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'Test',
      //right: 'month,agendaWeek,agendaDay'
      right: 'month, basicWeek, basicDay'
    },
    defaultDate: cDate,
    editable: true,
    events: {
      url: link+'/admin/appointments',
      error: function() {
        $('#test').html('error');
      }
    },
    
    // Function to handle a day click event
    dayClick: function(date, jsEvent, view) {
      alert('Clicked on: ' + date.format());
      $(this).css('background-color', 'red');
    },
    
    // Function to handle an event click event
    eventClick: function(calEvent, jsEvent, view) {
      alert('Event: ' + calEvent.title);
      $(this).css('border-color', 'red');
    }
  });
});