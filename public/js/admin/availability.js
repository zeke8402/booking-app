$(document).ready(function() {
  var url = document.getElementById('url');
  url = url.textContent;
  var cDate = new Date();

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
    // API call returns a json feed
    /*
    events: {
      url: url+'/api/get-all-appointments',
      error: function() {
        $('#error').html('Could not find any appointments');
      }
    },
    */
    
    // Function to handle a day click event
    // We need to set hidden value to date and show
    // availability widget
    dayClick: function(date, jsEvent, view) {
      //$(this).css('background-color', 'red');
      clickedDay(date, jsEvent, view);
    },
    
  });

  // Allow adding multiple times for that day
  $('#addAvailabilityBtn').click(function(){
    addTime('availabilityList');
  });

  function clickedDay(calDate, jsEvent, view)
  {
    $('input[name=dateSelected]').val(calDate.format("YYYY-MM-DD"));
    $('#clickedDay').empty();
    $('#clickedDay').append(calDate.format("MMMM Do, YYYY"));
  }

  function addTime(listId)
  {
    var list = $('#'+listId);
    var listCount = list.children().length;
    var newTime = list.find('li:first').clone().attr({id: "newTime"});
    newTime.find('#time').empty();
    newTime.appendTo(list);
  }

  $('#removeAvailabilityBtn').click(function() {
    removeTime('availabilityList');
  });

  function removeTime(listId)
  {
    var list = $('#'+listId);
    var listCount = list.children().length;
    if(listCount <= 1) {
      alert("You must select at least one time");
    } else {
      $('#'+listId+' li:last').remove();
    }
  }

});