$(document).ready(function() {
  var cDate = new Date();
  console.log(link);
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'Test',
      right: 'month,agendaWeek,agendaDay'
    },
    defaultDate: '2014-08-19',
    editable: true,
    events: {
      url: link+'/admin/appointments',
      error: function() {
        $('#test').html('error');
      }
    }
  });
});