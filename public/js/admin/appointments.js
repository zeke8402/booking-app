$(document).ready(function() {
  var url = document.getElementById('url');
  url = url.textContent;
  var cDate = new Date();

  // Calendar initialization
  $('#calendar').fullCalendar({
    editable: true,
    header: {
      left: 'prev,next today',
      center: 'Appointments',
      right: 'month, agendaWeek, agendaDay'
    },
    defaultDate: cDate,
    defaultView: 'agendaWeek',
    // API call returns a json feed
    events: {
      url: url+'/api/get-all-appointments',
      error: function() {
        $('#error').html('Could not find any appointments');
      }
    },
    
    // Function to handle a day click event
    dayClick: function(date, jsEvent, view) {
      $(this).css('background-color', 'red');
    },
    
    // Function to handle an event click event
    eventClick: function(calEvent, jsEvent, view) {
      $(this).css('border-color', 'red');
    }
  });
});