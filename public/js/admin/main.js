$(document).ready(function() {
  var url = document.getElementById('url');
  url = url.textContent;
  var cDate = new Date();

  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'Test',
      right: 'month, basicWeek, basicDay'
    },
    defaultDate: cDate,
    editable: true,
    events: {
      url: url+'/admin/appointments',
      error: function() {
        $('#error').html('error');
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