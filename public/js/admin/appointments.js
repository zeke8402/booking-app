$(document).ready(function() {
  var url = document.getElementById('url');
  url = url.textContent;
  var cDate = new Date();

  // Calendar initialization
  $('#calendar').fullCalendar({
    editable: false,
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month, agendaWeek, agendaDay'
    },
    eventLimit: true,
    defaultDate: cDate,
    defaultView: 'month',
    // API call returns a json feed
    events: {
      url: url+'/api/get-all-appointments',
      error: function() {
        $('#error').html('Could not find any appointments');
      }
    },
    
    // Function to handle a day click event
    dayClick: function(date, jsEvent, view) {
      //$(this).css('background-color', 'red');
    },
    
    // Function to handle an event click event
    eventClick: function(calEvent, jsEvent, view) {
      var detailView = $('#appointment-details');
      $.get(url+"/api/get-appointment-info/"+calEvent.id, 
        function(data) {
          var start = moment(calEvent.start).format(' h:mm a');
          var end = moment(calEvent.end).format(' h:mm a');
          var details = '<h5>'+calEvent.title+'</h5>' +
          '<form action="/admin/sendsms" method="get" id="smsForm">'+
          '<input type="hidden"  id="phoneNumber" name ="number" value="'+calEvent.number+'">'+
          '<input type="hidden"  id="startTime" name ="number" value="'+start+'">'+
            '<p><b>Begins</b>: '+start+'</p>' +
            '<p><b>Ends</b>: '+end+'</p>' +
            '<p><b>Phone</b>: '+calEvent.number+'</p>' +
            '<p><b>Email</b>: '+calEvent.email+'</p>' +
            '<textarea name="text" id="text"  placeholder="Enter message" cols="40" rows="3"></textarea><br><input type="submit" value="Sent SMS"></form> ';
          detailView.empty();
          detailView.append(details);
        });

    },
  });



   

});