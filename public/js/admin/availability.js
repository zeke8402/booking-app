$(document).ready(function() {

  var url = document.getElementById('url');
  url = url.textContent;
  var cDate = new Date();
  var token = $('meta[name="csrf-token"]').attr('content');

  // Calendar initialization
  $('#calendar').fullCalendar({
    editable: false,
    header: {
      left: 'prev,next today',
      center: 'Appointments',
      right: 'month, agendaWeek, agendaDay'
    },
    defaultDate: cDate,
    defaultView: 'agendaWeek',
    events: {
     url: url+'/api/get-all-availability',
     success: function(e) {
     },
     error: function() {
      $('#error').html('There was an error retrieiving Availability.');
     } 
    },
    selectable: true,
    select: function(start, end) {
      var title = confirm('Are you sure you want to set this availability?');
      var eventData;
      // Save it to DB and show
      if (title) {

        eventData = {
          _token: token,
          start: start.format(),
          end: end.format(),
        };

        $.ajax({
          type: "POST",
          url: url+'/api/set-availability',
          data: eventData,
          success: function(data) {
            $('#calendar').fullCalendar('refetchEvents');
          },
          error: function(data) {
            console.log('Error Processing');
          },
          dataType: "json",
        });
      }
    },
  });

  function refreshCalendar()
  {
    $('#calendar').fullCalendar('refetchEvents');
  }
});